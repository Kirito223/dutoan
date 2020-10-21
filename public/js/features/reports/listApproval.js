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
    let result = await reportApi.getListApproval(page);
    let html = "";
    let index = 1;
    if (result.data.length > 0) {
        result.data.forEach(item => {
            let kind = "Năm";
            if (item.report.kind == MONTH) {
                kind = "Tháng";
            }
            if (item.report.kind == PRECIOUS) {
                kind = "Quý";
            }

            html += `<tr>
            <td>${index}</td>
            <td><a href="/estimates/viewDetail/${item.id}">${
                item.report.name
            }</a></td>
            <td>${kind}</td>
            <td>${moment(item.report.date).format("DD/MM/YYYY")}</td>
            <td>${item.report.department.name}</td>
            <td>
            <button data-id="${
                item.report.id
            }" class="btn btn-primary btn-sm btnView">Xem</button>
            </td>
            </tr>`;
            index++;
        });
        bodyTableReport.innerHTML = html;

        let btnView = document.getElementsByClassName("btnView");
        for (const btn of btnView) {
            btn.onclick = function(e) {
                window.location = "/report/viewApproval/" + btn.dataset.id;
            };
        }
        showPagination("#paginationTable", result.last_page, loadData);
    } else {
        bodyTableReport.innerHTML = `<tr>
            <td style="text-align:center;" colspan="6">Không có dự toán</td>
            </tr>`;
    }
}
