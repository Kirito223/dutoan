import evaluationApi from "../../api/evaluationApi.js";
var btnParentEvaluation, bodyTableEvaluation, parent, btnSave, name;
var htmlTable = "";
var htmlSelect = "";
window.onload = function() {
    initControl();
    initData();
    initEvent();
};
function initControl() {
    btnParentEvaluation = document.getElementById("btnParentEvaluation");
    bodyTableEvaluation = document.getElementById("bodyTableEvaluation");
    parent = document.getElementById("parent");
    name = document.getElementById("name");
    btnSave = document.getElementById("btnSave");
}
function initData() {
    Promise.all([loadData(), loadSelectbox()]);
}
function initEvent() {
    btnParentEvaluation.onclick = function(e) {
        $("#modelInfomationEvaluation").modal("show");
    };

    btnSave.onclick = function() {
        save();
    };
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
        parent: parent.value != "" ? parent.value : null
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
        <td class="tdBox"><button data-id="${element.id}" class="btn btn-sm btn-danger btnDelelete"><i class="fas fa-trash fa-sm fa-fw"></i> Xóa</button><button data-ttId=${element.id} class="btn btn-sm btn-info btnEdit" ><i class="fas fa-edit fa-sm fa-fw"></i> Sửa</button>
        </td>
        </tr>`;
            // arrResult.push(element);
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
                    <td class="tdBox"><button data-id="${element.id}" class="btn btn-sm btn-danger btnDelelete"><i class="fas fa-trash fa-sm fa-fw"></i> Xóa</button>
                    <button data-ttId=${element.id} class="btn btn-sm btn-info btnEdit" ><i class="fas fa-edit fa-sm fa-fw"></i> Sửa</button>
                    </td>
                    </tr>`;
            // arrResult.push(element);
            index++;
        }
    }
}
