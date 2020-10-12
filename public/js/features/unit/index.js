import unitApi from "../../api/unitApi.js";
import { showPagination } from "../../ultils/ultils.js";
var btnUnit, bodyTableUnit, btnSave, name;
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
    btnUnit = document.getElementById("btnUnit");
    bodyTableUnit = document.getElementById("bodyTableUnit");
    name = document.getElementById("name");
    btnSave = document.getElementById("btnSave");
}
function initData() {
    loadData(1);
}
function initEvent() {
    btnUnit.onclick = function(e) {
        name.value = null;
        showModal();
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
    let result = await unitApi.edit(data, idEdit);
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
    let result = await unitApi.save(data);
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
        name: name.value
    };
}


async function loadData(page) {
    let result = await unitApi.getData(page);
    showTable(result.data);
    bodyTableUnit.innerHTML = htmlTable;
    let btnEdit = document.getElementsByClassName("btnEdit");
    for (const btn of btnEdit) {
        btn.onclick = function(e) {
            let index = arrResult.findIndex(x => x.id == btn.dataset.ttid);
            idEdit = arrResult[index].id;
            name.value = arrResult[index].name;
            showModal();
        };
    }

    let btnDel = document.getElementsByClassName("btnDelelete");
    for (const btn of btnDel) {
        btn.onclick = function(e) {
            del(btn.dataset.id);
        };
    }
    showPagination("#paginationTable", last_page, loadData);
}
function showModal() {
    $("#modelInfomationUnit").modal("show");
}
async function del(id) {
    let result = await unitApi.delete(id);
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

function showTable(result) {
    let index = 1;
    result.forEach(item => {
        htmlTable += `<tr data-tt-id="${item.id}">
    <td>${index}</td>
    <td>${item.name}</td>
    <td class="tdBox">
    <button data-ttId=${item.id} class="btn btn-sm btn-info btnEdit" ><i class="fas fa-edit fa-sm fa-fw"></i> Sửa</button>
    <button data-id="${item.id}" class="btn btn-sm btn-danger btnDelelete"><i class="fas fa-trash fa-sm fa-fw"></i> Xóa</button>
    </td>
    </tr>`;
        arrResult.push(item);
        index++;
    });
}
