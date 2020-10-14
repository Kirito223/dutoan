import estimateApi from "../../api/estimatesApi.js";
import departmentApi from "../../api/departmentApi.js";
import { showPagination } from "../../ultils/ultils.js";
import { MONTH, YEAR, PRECIOUS } from "../../const/kindTemplate.js";

var bodyTableEstimate, selectAllDepartment, btnSendDepartment;
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
    btnSendDepartment = document.getElementById("btnSendDepartment");
}
function initEvent() {
    btnSendDepartment.onclick = function(e) {
        send();
    };
}
async function send() {
    let data = getData();
    let result = await estimateApi.send(data);
    if (result.msg == "ok") {
        Swal.fire("Đã gửi dự toán thành công", "Đã gửi dự toán", "success");
    }
}
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
    Promise.all([loadData(1), loadDepartment()]);
}
async function loadDepartment() {
    let result = await departmentApi.getData();
    showDepartment(result);
    bodyTableDepartment.innerHTML = htmlDepartment;
}
async function loadData(page) {
    let result = await estimateApi.fetch(page);
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

            html += `<tr>
            <td>${index}</td>
            <td>${item.name}</td>
            <td>${kind}</td>
            <td>${moment(item.date).format("DD/MM/YYYY")}</td>
            <td>${item.department.name}</td>
            <td>
            <button data-id="${
                item.id
            }" class="btn btn-primary btn-sm btnSend">Gửi</button>
            <button data-id="${
                item.id
            }" class="btn btn-primary btn-sm btnEdit">Sửa</button>
            <button data-id="${
                item.id
            }" class="btn btn-danger btn-sm btnDel">Xóa</button>
            </td>
            </tr>`;
            index++;
        });
        bodyTableEstimate.innerHTML = html;

        let view = document.getElementsByClassName("btnSend");

        for (const sendButton of view) {
            sendButton.onclick = function(e) {
                estimateSelect = sendButton.dataset.id;
                $("#modelSelectDepartment").modal("show");
            };
        }
        showPagination("#paginationTable", result.last_page, loadData);
    } else {
        bodyTableEstimate.innerHTML = `<tr>
            <td style="text-align:center;" colspan="7">Không có dự toán chờ phê duyệt</td>
            </tr>`;
    }
}

function showDepartment(result) {
    for (const item in result) {
        if (result[item].hasOwnProperty("children")) {
            let element = result[item];
            htmlDepartment += `<tr>
            <td><input data-parent="${element.parentDepartment}" class="chkDepartment" data-path="${element.path}" type="checkbox" value="${element.id}" data-name="${element.name}"/></td>
            <td>${element.name}</td>
            <td>${element.address}</td>
            </tr>`;
            showDepartment(result[item].children);
        } else {
            let element = result[item];
            htmlDepartment += `<tr>
            <td><input data-parent="${element.parentDepartment}" class="chkDepartment" data-path="${element.path}" type="checkbox" value="${element.id}" data-name="${element.name}"/></td>
            <td>${element.name}</td>
            <td>${element.address}</td>
            </tr>`;
        }
    }

    selectAllDepartment.onclick = function(e) {
        let chk = document.getElementsByClassName("chkDepartment");
        for (const chkItem of chk) {
            chkItem.checked = selectAllDepartment.checked;
        }
    };
}
