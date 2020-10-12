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
    let index = 1;
    result.data.forEach(element => {
        let kind = "Năm";
        if (element.kind == MONTH) {
            kind = "Tháng";
        }
        if (element.kind == PRECIOUS) {
            kind = "Quý";
        }
        html += `<tr>
        <td>${index}</td>
        <td>${element.name}</td>
        <td>${kind}</td>
        <td>${element.creator}</td>
        <td>${element.date}</td>
        <td></td>
        </tr>`;
    });
    bodyTableTemplate.innerHTML = html;
}
