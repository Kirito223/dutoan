import estimateApi from "../../api/estimatesApi.js";
import departmentApi from "../../api/departmentApi.js";
import reportApi from "../../api/reportApi.js";
import { showPagination } from "../../ultils/ultils.js";
import { YEAR, MONTH, PRECIOUS } from "../../const/kindTemplate.js";
var name,
    precious,
    month,
    year,
    selectEstimate,
    tableEstimate,
    bodyTableDepartment,
    send,
    content,
    idInput;
var arrEstimate = [];
window.onload = function() {
    initControl();
    initEvent();
    initData();
};

function initControl() {
    name = document.getElementById("name");
    precious = document.getElementById("precious");
    month = document.getElementById("month");
    year = document.getElementById("year");
    selectEstimate = document.getElementById("selectEstimate");
    tableEstimate = document.getElementById("tableEstimate");
    bodyTableDepartment = document.getElementById("bodyTableDepartment");
    send = document.getElementById("send");
    content = document.getElementById("content");
    idInput = document.getElementById("idInput");
}

function initEvent() {
    send.onclick = async function() {
        let result = await reportApi.edit(getData(), idInput.value);
        if (result.msg == "ok") {
            window.location = "/report";
        } else {
            Swal.fire(
                "Đã có lỗi xảy ra vui lòng thử lại sau",
                "Đã xảy ra lỗi vui lòng thử lại",
                "error"
            );
        }
    };
}

async function initData() {
    await Promise.all([loadEstimate(), loadDepartment()]);
    await loadEdit();
}

async function loadEdit() {
    let result = await reportApi.getEdit(idInput.value);
    let report = result.data.report;

    name.value = report.name;
    switch (report.kind) {
        case MONTH:
            month.checked = true;
            break;
        case PRECIOUS:
            precious.checked = true;
            break;
        case YEAR:
            year.checked = true;
            break;
    }

    content.value = report.content;
    let estimate = JSON.parse(report.estimate);
    estimate.forEach(item => {
        document.querySelector(`.chkEstimate[value="${item}"]`).checked = true;
        arrEstimate.push(item);
    });
    let send = result.data.send;
    send.forEach(item => {
        let chks = document.querySelector(`.chkDepartment[value="${item.to}"]`);
        chks.checked = true;
    });
}

function getData() {
    let kind = YEAR;
    if (precious.checked == true) {
        kind = PRECIOUS;
    }
    if (month.checked) {
        kind = MONTH;
    }
    let arrDepartment = [];
    let chkDepartment = document.querySelectorAll(`.chkDepartment:checked`);
    for (const chk of chkDepartment) {
        arrDepartment.push(chk.value);
    }
    return {
        name: name.value,
        kind: kind,
        estimates: JSON.stringify(arrEstimate),
        content: content.value,
        department: JSON.stringify(arrDepartment)
    };
}
async function loadEstimate() {
    let result = await estimateApi.fetch(1);
    let html = "";
    result.data.forEach(estimate => {
        html += `<tr>
        <td>
        <input class="chkEstimate" type="checkbox" value="${estimate.id}" />
        </td>
        <td>${estimate.name}</td>
        </tr>`;
    });
    tableEstimate.innerHTML = html;

    let chkEstimate = document.getElementsByClassName("chkEstimate");
    for (const chk of chkEstimate) {
        chk.onclick = function() {
            if (chk.checked == true) {
                let index = arrEstimate.findIndex(x => chk.value);
                if (index == -1) {
                    arrEstimate.push(chk.value);
                }
            } else {
                let index = arrEstimate.findIndex(x => chk.value);
                if (index > -1) {
                    arrEstimate.splice(index, 1);
                }
            }
        };
    }

    showPagination("#paginationEstimateTable", result.last_page, loadEstimate);
}

async function loadDepartment() {
    let result = await departmentApi.fetchDataWithoutTree();
    let html = "";
    result.forEach(department => {
        html += `<tr>
        <td><input class="chkDepartment" value="${department.id}" type="checkbox"/></td>
        <td>${department.name}</td>
        <td>${department.address}</td>
        </tr>`;
    });
    bodyTableDepartment.innerHTML = html;
}
