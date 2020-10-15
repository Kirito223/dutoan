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
    idEstimate,
    btnSendAdditional,
    content,
    signbox,
    sign;

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
    btnSendAdditional = document.getElementById("btnSendAdditional");
    content = document.getElementById("content");
    signbox = document.getElementById("signbox");
    sign = document.getElementById("sign");
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

    if (header.account != null) {
        signbox.classList.remove("hidden");
        sign.textContent = header.account.name;
    }

    let body = result.body;
    let html = "";
    let index = 1;
    for (const key in body) {
        let dataParent =
            body[key].parentId == null
                ? ""
                : ` data-tt-parent-id=${body[key].parentId}`;
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

function initEvent() {
    btnApproval.onclick = function() {
        approval();
    };
    btnReject.onclick = function(e) {
        reject();
    };
    btnAdditional.onclick = function() {
        $("#modelAdditional").modal("show");
    };
    btnSendAdditional.onclick = function(e) {
        additional();
    };
}

async function additional() {
    let result = await estimatesApi.additional(
        { content: content.value },
        idEstimate.value
    );
    if (result.msg == "ok") {
        Swal.fire(
            "Hoàn tất yêu cầu sửa đổi bổ sung",
            "Đã yêu cầu sửa đổi bổ sung",
            "success"
        );
        $("#modelAdditional").modal("toogle");
    } else {
        Swal.fire(
            "Đã có lỗi xảy ra vui lòng kiểm tra lại",
            "Đã có lỗi xảy ra vui lòng kiểm tra lại",
            "success"
        );
    }
}

async function approval() {
    let result = await estimatesApi.approval(idEstimate.value);
    let icon = "success";
    if (result.msg == "fail") {
        icon = "error";
    }
    Swal.fire(result.data, result.data, icon);
}
async function reject() {
    let result = await estimatesApi.reject(idEstimate.value);
    let icon = "success";
    if (result.msg == "fail") {
        icon = "error";
    }
    Swal.fire(result.data, result.data, icon);
}
