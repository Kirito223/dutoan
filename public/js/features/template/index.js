var bodyTableTemplate, btnAddNewTemplate;
import templateApi from "../../api/templateApi.js";
import { MONTH, YEAR, PRECIOUS } from "../../const/kindTemplate.js";
window.onload = function() {
    initControl();
    initEvent();
    initData();
};

function initControl() {
    bodyTableTemplate = document.getElementById("bodyTableTemplate");
    btnAddNewTemplate = document.getElementById("btnAddNewTemplate");
}

function initEvent() {
    btnAddNewTemplate.onclick = function(e) {
        window.location = "template/detail";
    };
}
function initData() {
    loadData(1);
}
async function loadData(page) {
    let result = await templateApi.fetch(page);
    let html = "";
    result.data.forEach(element => {
        let kind = "Năm";
        if (element.time == MONTH) {
            kind = "Tháng";
        }
        if (element.time == PRECIOUS) {
            kind = "Quý";
        }
        html += `<tr>
        <td>${element.name}</td>
        <td>${kind}</td>
        <td>${element.creator}</td>
        <td>${element.date}</td>
        <td>
        <button data-id="${element.id}" class="btn btn-success btn-sm btnEdit"><i class="fas fa-edit"></i> Sửa</button>
        <button data-id="${element.id}" class="btn btn-danger btn-sm btnDel"> <i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
        </td>
        </tr>`;
    });
    bodyTableTemplate.innerHTML = html;

    let btnDel = document.getElementsByClassName("btnDel");

    for (const btn of btnDel) {
        btn.onclick = function(e) {
            const result = templateApi.del(btn.dataset.id);
            if ((result.msg = "ok")) {
                window.location.reload();
            }
        };
    }
    let btnEdit = document.getElementsByClassName("btnEdit");
    for (const btn of btnEdit) {
        btn.onclick = function(e) {
            window.location = "/template/edit/" + btn.dataset.id;
        };
    }
}
