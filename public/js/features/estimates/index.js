import templateApi from "../../api/templateApi.js";
import estimateApi from "../../api/estimatesApi.js";
import { MONTH, YEAR, PRECIOUS } from "../../const/kindTemplate.js";
var name, department, precious, month, year, template, BodyEvaluation, btnSave;
var htmlTable = "";
var arrResult = [];

window.onload = function() {
    initControl();
    initData();
    initEvent();
};

function initControl() {
    name = document.getElementById("name");
    department = document.getElementById("department");
    precious = document.getElementById("precious");
    month = document.getElementById("month");
    year = document.getElementById("year");
    template = document.getElementById("template");
    BodyEvaluation = document.getElementById("BodyEvaluation");
    btnSave = document.getElementById("btnSave");
}
function initEvent() {
    template.addEventListener("change", function() {
        loadEvaluation(template.value);
    });
    btnSave.onclick = function(e) {
        save();
    };
}

function initData() {
    loadTemplate();
}

async function loadEvaluation(template) {
    let result = await templateApi.getTemplate(template);
    showTable(result);
    BodyEvaluation.innerHTML = htmlTable;
    $("#tableEvaluation").treetable({
        expandable: true
    });

    let inputValue = document.getElementsByClassName("inputValue");
    for (const input of inputValue) {
        input.addEventListener("keyup", function(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                let index = arrResult.findIndex(x => x.id == input.dataset.id);
                if (index > -1) {
                    arrResult[index].value = Number(input.value);
                }
            }
        });
        input.addEventListener("focusout", function(e) {
            e.preventDefault();
            let index = arrResult.findIndex(x => x.id == input.dataset.id);
            if (index > -1) {
                arrResult[index].value = Number(input.value);
            }
        });
    }
}

async function save() {
    let data = getData();
    let result = await estimateApi.save(data);
    if (result.msg == "ok") {
        window.location = "/estimates/list";
    }
}

function getData() {
    let kind = 1;
    if (precious.checked) {
        kind = PRECIOUS;
    }
    if (month.checked) {
        kind = MONTH;
    }
    if (year.checked) {
        kind = YEAR;
    }

    return {
        name: name.value,
        kind: kind,
        template: template.value,
        listEvaluation: JSON.stringify(arrResult)
    };
}

async function loadTemplate() {
    let result = await templateApi.fetchAll();
    let html = "";
    result.forEach(element => {
        html += `<option value="${element.id}">${element.name}</option>`;
    });
    template.innerHTML = `<option value="">----------------</option>` + html;
}

function showTable(result, index = 1) {
    for (const element in result) {
        let dataParent =
            result[element].parentId == null
                ? ""
                : ` data-tt-parent-id=${result[element].parentId}`;
        htmlTable += `<tr data-tt-id="${result[element].id}" ${dataParent}>
                    <td>${index}</td>
                    <td>${result[element].name}</td>
                    <td class="">
                        ${result[element].unit}
                    </td>
                    <td class="">
                   <input data-id="${result[element].id}" data-parent="${result[element].parentId}" data-path="${result[element].path}" type="text" class="form-control inputValue"/>
                </td>
                    </tr>`;
        index++;
        arrResult.push({
            id: result[element].id,
            name: result[element].name,
            value: 0
        });
    }
}
