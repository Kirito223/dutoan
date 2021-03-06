import unitApi from "../../api/unitApi.js";
import evaluationApi from "../../api/evaluationApi.js";
var btnParentEvaluation, bodyTableEvaluation, parent, btnSave, name, unit;
var htmlTable = "";
var htmlSelect = "";
var arrResult = [];
var idEdit = null;
window.onload = function() {
    initControl();
    initData();
    initEvent();
};
function initControl() {
    btnParentEvaluation = document.getElementById("btnParentEvaluation");
    bodyTableEvaluation = document.getElementById("bodyTableEvaluation");
    unit = document.getElementById("unit");
    parent = document.getElementById("parent");
    name = document.getElementById("name");
    btnSave = document.getElementById("btnSave");
}
function initData() {
    Promise.all([loadData(), loadSelectbox(), loadUnit()]);
}
function initEvent() {
    btnParentEvaluation.onclick = function(e) {
        name.value = null;
        parent.value = "";
        $("#modelInfomationEvaluation").modal("show");
    };

    btnSave.onclick = function() {
        if (idEdit == null) {
            save();
        } else {
            edit();
        }
    };
}

async function edit() {
    let data = getData();
    let result = await evaluationApi.edit(data, idEdit);
    if ((result.msg = "ok")) {
        window.location.reload();
    } else {
        Swal.fire(
            "Lưu không thành công",
            "Đã có lỗi xảy ra vui lòng thử lại sau",
            "error"
        );
    }
}

async function save() {
    let data = getData();
    let result = await evaluationApi.save(data);
    if ((result.msg = "ok")) {
        window.location.reload();
    } else {
        Swal.fire(
            "Lưu không thành công",
            "Đã có lỗi xảy ra vui lòng thử lại sau",
            "error"
        );
    }
}

function getData() {
    return {
        name: name.value,
        parent: parent.value != "" ? parent.value : null,
        unit: unit.value
    };
}

async function loadSelectbox() {
    let result = await evaluationApi.getData();
    showSelectbox(result);
    parent.innerHTML = `<option value="">Không có</option>` + htmlSelect;
}

async function loadData() {
    let result = await evaluationApi.getData();
    showTable(result);
    bodyTableEvaluation.innerHTML = htmlTable;
    $("#tableEvaluation").treetable({
        expandable: true
    });
    let listBtnAddChild = document.getElementsByClassName("btnAddChild");
    for (const btn of listBtnAddChild) {
        btn.onclick = function(e) {
            idEdit = null;
            name.value = null;
            parent.value = btn.dataset.id;
            $("#modelInfomationEvaluation").modal("show");
        };
    }
    let btnEdit = document.getElementsByClassName("btnEdit");
    for (const btn of btnEdit) {
        btn.onclick = function(e) {
            let index = arrResult.findIndex(x => x.id == btn.dataset.ttid);
            idEdit = arrResult[index].id;
            name.value = arrResult[index].name;
            parent.value =
                arrResult[index].parentId != null
                    ? arrResult[index].parentId
                    : "";
            unit.value = arrResult[index].unit;
            $("#modelInfomationEvaluation").modal("show");
        };
    }

    let btnDel = document.getElementsByClassName("btnDelelete");
    for (const btn of btnDel) {
        btn.onclick = function(e) {
            del(btn.dataset.id);
        };
    }
}

async function loadUnit() {
    let result = await unitApi.getAll();
    let html = "";
    result.forEach(element => {
        html += `<option value="${element.id}">${element.name}</option>`;
    });

    unit.innerHTML = html;
}

async function del(id) {
    let result = await evaluationApi.delete(id);
    if ((result.msg = "ok")) {
        window.location.reload();
    } else {
        Swal.fire(
            "Không thể xóa!!!!!",
            "Đã có lỗi xảy ra vui lòng thử lại sau",
            "error"
        );
    }
}

function showSelectbox(result) {
    for (const item in result) {
        if (result[item].hasOwnProperty("children")) {
            let element = result[item];
            htmlSelect += `<option value="${element.id}">${element.name}</option>`;

            showSelectbox(result[item].children);
        } else {
            let element = result[item];

            htmlSelect += `<option value="${element.id}">${element.name}</option>`;
        }
    }
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
        <td>${index}</td>
        <td>${element.name}</td>
        
        <td class="tdBox">
        <button data-ttId=${element.id} class="btn btn-sm btn-primary btnAddChild" ><i class="fas fa-edit fa-sm fa-fw"></i> Thêm chỉ tiêu con</button>
        <button data-ttId=${element.id} class="btn btn-sm btn-info btnEdit" ><i class="fas fa-edit fa-sm fa-fw"></i> Sửa</button>
        <button data-id="${element.id}" class="btn btn-sm btn-danger btnDelelete"><i class="fas fa-trash fa-sm fa-fw"></i> Xóa</button>
        </td>
        </tr>`;
            arrResult.push(element);
            index++;
            showTable(result[item].children, index);
        } else {
            let element = result[item];
            let dataParent =
                element.parentId == null
                    ? ""
                    : ` data-tt-parent-id=${element.parentId}`;
            htmlTable += `<tr data-tt-id="${element.id}" ${dataParent}>
                    <td>${index}</td>
                    <td>${element.name}</td>
                    <td class="tdBox">
                    <button data-id=${element.id} class="btn btn-sm btn-primary btnAddChild" ><i class="fas fa-edit fa-sm fa-fw"></i> Thêm chỉ tiêu con</button>
                    <button data-ttId=${element.id} class="btn btn-sm btn-info btnEdit" ><i class="fas fa-edit fa-sm fa-fw"></i> Sửa</button>
                    <button data-id="${element.id}" class="btn btn-sm btn-danger btnDelelete"><i class="fas fa-trash fa-sm fa-fw"></i> Xóa</button>
                    </td>
                    </tr>`;
            arrResult.push(element);
            index++;
        }
    }
}
