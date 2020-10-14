import estimateApi from "../../api/estimatesApi.js";
import departmentApi from "../../api/departmentApi.js";
import { showPagination } from "../../ultils/ultils.js";
import {
    MONTH,
    YEAR,
    PRECIOUS,
    REQUEST,
    REJECT,
    APPROVAL,
    ADDITIONAL
} from "../../const/kindTemplate.js";

var bodyTableEstimate, selectAllDepartment;
var htmlDepartment = "";
var estimateSelect;

window.onload = function() {
    initControl();
    initEvent();
    initData();
};

function initControl() {
    bodyTableEstimate = document.getElementById("bodyTableEstimate");
    selectAllDepartment = document.getElementById("selectAllDepartment");
}
function initEvent() {}
function getData() {
    let arrSelected = [];
    let chkSelect = document.querySelectorAll(`.chkDepartment:checked`);
    for (const chk of chkSelect) {
        arrSelected.push(chk.value);
    }
    return {
        estimate: estimateSelect,
        to: JSON.stringify(arrSelected),
        estimateName: name.value
    };
}

function initData() {
    loadData(1);
}

async function loadData(page) {
    let result = await estimateApi.listApproval(page);
    bodyTableEstimate.innerHTML = "";
    let html = "";
    let index = 1;
    if (result.data.length > 0) {
        result.data.forEach(item => {
            let kind = "Năm";
            if (item.time == MONTH) {
                kind = "Tháng";
            }
            if (item.time == PRECIOUS) {
                kind = "Quý";
            }
            let status = "Chờ duyệt";
            switch (item.accept) {
                case APPROVAL:
                    status = "Phê duyệt";
                    break;
                case REJECT:
                    status = "Từ chối";
                    break;
                case ADDITIONAL:
                    status = "Bổ sung";
                    break;
                default:
                    status = "Chờ duyệt";
                    break;
            }
            html += `<tr>
            <td>${index}</td>
            <td>${item.name}</td>
            <td>${kind}</td>
            <td>${moment(item.date).format("DD/MM/YYYY")}</td>
            <td>${item.creator}</td>
            <td>${status}</td>
            <td>
            <button data-id="${
                item.id
            }" class="btn btn-success btn-sm btnView"><i class="far fa-eye"></i> Xem</button>
            </td>
            </tr>`;
            index++;
        });
        bodyTableEstimate.innerHTML = html;

        let view = document.getElementsByClassName("btnView");

        for (const viewButton of view) {
            viewButton.onclick = function(e) {
                estimateSelect = viewButton.dataset.id;
                window.location = "/estimates/viewDetail/" + estimateSelect;
            };
        }
        showPagination("#paginationTable", result.last_page, loadData);
    } else {
        bodyTableEstimate.innerHTML = `<tr>
            <td style="text-align:center;" colspan="7">Không có dự toán chờ phê duyệt</td>
            </tr>`;
    }
}
