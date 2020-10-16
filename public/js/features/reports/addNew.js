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
    content;
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
}

function initEvent() {
    send.onclick = async function() {
        let result = await reportApi.save(getData());
        if (result.msg == "ok") {
            alert("Da luu");
        }
    };
}

function initData() {
    Promise.all([loadEstimate(), loadDepartment()]);
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
    let chkDepartment = document.querySelectorAll(`chkDepartment:checked`);
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
    arrEstimate.forEach(value => {
        let chk = document.querySelector(`.chkEstimate[value=${value}]`);
        chk.checked = true;
    });
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
