import noticeApi from "../../api/noticeApi.js";
import { showPagination } from "../../ultils/ultils.js";
var bodyTableNotice;
window.onload = function() {
    initControl();
    initEvent();
    initData();
};

function initControl() {
    bodyTableNotice = document.getElementById("bodyTableNotice");
}
function initEvent() {}
function initData() {
    loadData(1);
}

async function loadData(page) {
    let result = await noticeApi.getNoticeReciver(page);
    bodyTableNotice.innerHTML = "";
    let html = "";
    let index = 1;
    if (result.data.length > 0) {
        result.data.forEach(item => {
            html += `<tr>
            <td>${index}</td>
            <td>${item.title}</td>
            <td>${item.name}</td>
            <td>${item.dateSend}</td>
            <td><button data-id="${item.id}" class="btn btn-primary btn-sm viewNotice">Xem</button></td>
            </tr>`;
        });
        bodyTableNotice.innerHTML = html;

        let view = document.getElementsByClassName("viewNotice");

        for (const viewButton of view) {
            viewButton.onclick = function(e) {
                window.location = `viewNotice/${e.target.dataset.id}/home`;
            };
        }
        showPagination("#paginationTable", result.last_page, loadData);
    } else {
        bodyTableNotice.innerHTML = `<tr>
            <td colspan="5">Không có thông báo nào</td>
            </tr>`;
    }
}
