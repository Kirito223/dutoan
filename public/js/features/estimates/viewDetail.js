import { PRECIOUS, MONTH } from "../../const/kindTemplate.js";
import estimatesApi from "../../api/estimatesApi.js";

var name,
    department,
    time,
    template,
    BodyEvaluation,
    btnApproval,
    btnReject,
    btnAdditional,
    idEstimate;

window.onload = function() {
    initControl();
    initData();
    initEvent();
};

function initControl() {
    name = document.getElementById("name");
    department = document.getElementById("department");
    time = document.getElementById("time");
    template = document.getElementById("template");
    BodyEvaluation = document.getElementById("BodyEvaluation");
    btnApproval = document.getElementById("btnApproval");
    btnReject = document.getElementById("btnReject");
    btnAdditional = document.getElementById("btnAdditional");
    idEstimate = document.getElementById("idEstimate");
}

function initData() {
    load();
}

async function load() {
    let result = await estimatesApi.viewDetail(idEstimate.value);
    let header = result.header;
    name.textContent = header.name;
    department.textContent = header.department.name;
    template.textContent = header.template.name;
    switch (header.time) {
        case PRECIOUS:
            time.textContent = "Quý";
            break;
        case MONTH:
            time.textContent = "Tháng";
            break;

        default:
            time.textContent = "Năm";
            break;
    }

    let body = result.body;
    let html = "";
    let index = 1;
    for (const key in body) {
        let dataParent =
            body[key].parentId == null ? "" : ` data-tt-parent-id=${body[key].parentId}`;
        html += `<tr data-tt-id="${body[key].id}" ${dataParent}>
            <td>${index}</td>
            <td>${body[key].name}</td>
            <td class="">
                ${body[key].unit}
            </td>
            <td class="">
           ${body[key].value}
        </td>
            </tr>`;
        index++;
    }

    BodyEvaluation.innerHTML = html;
    $("#tableEvaluation").treetable({
        expandable: false
    });
}

function initEvent() {}
