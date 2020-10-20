import reportApi from "../../api/reportApi.js";
import { showPagination } from "../../ultils/ultils.js";
import { MONTH, YEAR, PRECIOUS } from "../../const/kindTemplate.js";

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

            html += `<tr>
            <td>${index}</td>
            <td><a href="/estimates/viewDetail/${item.id}">${item.name}</a></td>
            <td>${kind}</td>
            <td>${moment(item.date).format("DD/MM/YYYY")}</td>
            <td>${item.department.name}</td>
            <td>
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
    let result = reportApi.del(id);
    if (result.msg == "fail") {
        Swal.fire(result.data, result.data, "warning");
    } else {
        window.location.reload();
    }
}
