import reportApi from "../../api/reportApi.js";
import { showPagination } from "../../ultils/ultils.js";
import {
    MONTH,
    YEAR,
    PRECIOUS,
    APPROVAL,
    REJECT,
    ADDITIONAL
} from "../../const/kindTemplate.js";

var bodyTableReport;

window.onload = function() {
    initControl();
    initEvent();
    initData();
};

function initControl() {
    bodyTableReport = document.getElementById("bodyTableReport");
}
function initEvent() {}

function initData() {
    loadData(1);
}

async function loadData(page) {
    let result = await reportApi.getData(page);
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
            let status = "Chờ phê duyệt";

            switch (item.status) {
                case APPROVAL:
                    status = "Đã duyệt";
                    break;
                case REJECT:
                    status = "Từ chối";
                    break;
                case ADDITIONAL:
                    status = "Yêu cầu sửa đổi bổ sung";
                    break;

                default:
                    break;
            }
            html += `<tr>
            <td>${index}</td>
            <td><a href="/report/viewDetail/${item.id}">${item.name}</a></td>
            <td>${kind}</td>
            <td>${moment(item.date).format("DD/MM/YYYY")}</td>
            <td>${item.department.name}</td>
            <td>
            ${status}
            </td>
            <td>
            <button data-id="${
                item.id
            }" class="btn btn-primary btn-sm btnEdit" ${
                item.status == APPROVAL || item.status == REJECT
                    ? "disabled"
                    : ""
            }> <i class="far fa-edit"></i>Sửa</button>
            <button data-id="${item.id}" class="btn btn-danger btn-sm btnDel" ${
                item.status == APPROVAL || item.status == REJECT
                    ? "disabled"
                    : ""
            }> <i class="fa fa-trash"></i> Xóa</button>
            </td>
            </tr>`;
            index++;
        });
        bodyTableReport.innerHTML = html;

        let btnEdit = document.getElementsByClassName("btnEdit");
        for (const btn of btnEdit) {
            btn.onclick = function(e) {
                window.location = "/report/edit/" + btn.dataset.id;
            };
        }

        let btnDel = document.getElementsByClassName("btnDel");
        for (const btn of btnDel) {
            btn.onclick = function(e) {
                del(btn.dataset.id);
            };
        }
        showPagination("#paginationTable", result.last_page, loadData);
    } else {
        bodyTableReport.innerHTML = `<tr>
            <td style="text-align:center;" colspan="6">Không có dự toán</td>
            </tr>`;
    }
}
function del(id) {
    let result = reportApi.delete(id);
    if (result.msg == "fail") {
        Swal.fire(result.data, result.data, "warning");
    } else {
        window.location.reload();
    }
}
