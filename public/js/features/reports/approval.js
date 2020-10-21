import reportApi from "../../api/reportApi.js";
var btnApproval,
    btnAdditional,
    btnReject,
    reportId,
    btnSendAdditional,
    contentSend;

window.onload = function() {
    initControl();
    initEvent();
};

function initControl() {
    btnApproval = document.getElementById("btnApproval");
    btnAdditional = document.getElementById("btnAdditional");
    btnReject = document.getElementById("btnReject");
    reportId = document.getElementById("reportId");
    btnSendAdditional = document.getElementById("btnSendAdditional");
    contentSend = document.getElementById("contentSend");
}

function initEvent() {
    btnApproval.onclick = function() {
        approval();
    };

    btnReject.onclick = function() {
        reject();
    };
    btnAdditional.onclick = function() {
        $("#modelAdditional").modal("show");
    };
    btnSendAdditional.onclick = function() {
        send();
    };
}

async function send() {
    let result = await reportApi.additional(reportId.value, {
        content: contentSend.value
    });
    if (result.msg == "ok") {
        Swal.fire(result.data, result.data, "success");
    } else {
        Swal.fire(result.data, result.data, "error");
    }
}
async function approval() {
    let result = await reportApi.approval(reportId.value);
    if (result.msg == "ok") {
        Swal.fire(result.data, result.data, "success");
    } else {
        Swal.fire(result.data, result.data, "error");
    }
}
async function reject() {
    let result = await reportApi.reject(reportId.value);
    if (result.msg == "ok") {
        Swal.fire(result.data, result.data, "success");
    } else {
        Swal.fire(result.data, result.data, "error");
    }
}
