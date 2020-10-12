import templateApi from "../../api/templateApi.js";
import departmentApi from "../../api/departmentApi.js";
import evaluationApi from "../../api/evaluationApi.js";
import { MONTH, YEAR, PRECIOUS } from "../../const/kindTemplate.js";

var evaluationTable,
    bodyTableEvaluation,
    name,
    number,
    precious,
    month,
    year,
    department,
    selectDepartment,
    tableDepartment,
    bodyTableDepartment,
    SelectedDepartment,
    selectAllEvaluation,
    selectAllDepartment;

var htmlTable = "",
    htmlDepartment = "";

window.onload = function() {
    initControl();
    initEvent();
    initData();
};

function initControl() {
    evaluationTable = document.getElementById("evaluationTable");
    bodyTableEvaluation = document.getElementById("bodyTableEvaluation");
    name = document.getElementById("name");
    number = document.getElementById("number");
    precious = document.getElementById("precious");
    month = document.getElementById("month");
    year = document.getElementById("year");
    department = document.getElementById("department");
    selectDepartment = document.getElementById("selectDepartment");
    tableDepartment = document.getElementById("tableDepartment");
    bodyTableDepartment = document.getElementById("bodyTableDepartment");
    SelectedDepartment = document.getElementById("SelectedDepartment");
    selectAllEvaluation = document.getElementById("selectAllEvaluation");
    selectAllDepartment = document.getElementById("selectAllDepartment");
}

function initEvent() {
    selectDepartment.onclick = function(e) {
        $("#modelSelectDepartment").modal("show");
    };
}

async function initData() {
    await Promise.all([loadEvaluation(), loadDepartment()]);
}

async function loadDepartment() {
    let result = await departmentApi.getData();
    showDepartment(result);
    bodyTableDepartment.innerHTML = htmlDepartment;
}

async function loadEvaluation() {
    let result = await evaluationApi.getData(1);
    showTable(result);
    bodyTableEvaluation.innerHTML = htmlTable;
    $("#evaluationTable").treetable({
        expandable: true
    });
    selectAllEvaluation.onclick = function(e) {
        let chk = document.getElementsByClassName("chkEvaluation");
        for (const chkItem of chk) {
            chkItem.checked = selectAllEvaluation.checked;
        }
    };

    let chkDepartment = document.getElementsByClassName("chkEvaluation");
    for (const chk of chkDepartment) {
        chk.onclick = function(e) {
            let path = chk.dataset.path;
            if (path != "null") {
                path = path.split("-");
                path.forEach(element => {
                    if (element != "") {
                        let item = document.querySelector(
                            `.chkEvaluation[value="${element}"]`
                        );
                        item.checked = chk.checked;
                    }
                });
            }

            let child = document.querySelectorAll(
                `.chkEvaluation[data-parent="${chk.value}"]`
            );
            for (const chkChild of child) {
                chkChild.checked = chk.checked;
            }
        };
    }
}

function showDepartment(result) {
    for (const item in result) {
        if (result[item].hasOwnProperty("children")) {
            let element = result[item];
            htmlDepartment += `<tr>
            <td><input data-parent="${element.parentDepartment}" class="chkDepartment" data-path="${element.path}" type="checkbox" value="${element.id}" data-name="${element.name}"/></td>
            <td>${element.name}</td>
            <td>${element.address}</td>
            </tr>`;
            showDepartment(result[item].children);
        } else {
            let element = result[item];
            htmlDepartment += `<tr>
            <td><input data-parent="${element.parentDepartment}" class="chkDepartment" data-path="${element.path}" type="checkbox" value="${element.id}" data-name="${element.name}"/></td>
            <td>${element.name}</td>
            <td>${element.address}</td>
            </tr>`;
        }
    }

    selectAllDepartment.onclick = function(e) {
        let chk = document.getElementsByClassName("chkDepartment");
        for (const chkItem of chk) {
            chkItem.checked = selectAllDepartment.checked;
        }
    };
}

function showTable(result, index = 1) {
    for (const item in result) {
        if (result[item].hasOwnProperty("children")) {
            let element = result[item];
            let dataParent =
                element.parentId == null
                    ? ""
                    : ` data-tt-parent-id=${element.parentId}`;
            htmlTable += `<tr data-tt-id="${element.id}" ${dataParent}>
        <td><input data-path="${element.path}" class="chkEvaluation" data-parent="${element.parentId}" type="checkbox" value="${element.id}"/></td>
            <td>${index}</td>
        <td>${element.name}</td>
        <td>${element.unit.name}</td>
        </tr>`;

            index++;
            showTable(result[item].children, index);
        } else {
            let element = result[item];
            let dataParent =
                element.parentId == null
                    ? ""
                    : ` data-tt-parent-id=${element.parentId}`;
            htmlTable += `<tr data-tt-id="${element.id}" ${dataParent}>
            <td><input data-path="${element.path}" class="chkEvaluation" data-parent="${element.parentId}" type="checkbox" value="${element.id}"/></td>
                    <td>${index}</td>
                    <td>${element.name}</td>
                    <td>
                    ${element.unit.name}
                    </td>
                    </tr>`;

            index++;
        }
    }
}
