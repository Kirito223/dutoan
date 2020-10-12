import noticeApi from "../../api/noticeApi.js";
import departmentApi from "../../api/departmentApi.js";
import { showPagination } from "../../ultils/ultils.js";

var title,
    file,
    selectDepartment,
    content,
    send,
    bodyTableNotice,
    bodyTableDepartment,
    btnOKSelectedDepartment,
    department;

var arrDepartment = [];
var edit = null;
window.onload = function() {
    initControl();
    initEvent();
    initData();
};

function initControl() {
    title = document.getElementById("title");
    file = document.getElementById("file");
    selectDepartment = document.getElementById("selectDepartment");
    content = document.getElementById("content");
    send = document.getElementById("send");
    bodyTableNotice = document.getElementById("bodyTableNotice");
    bodyTableDepartment = document.getElementById("bodyTableDepartment");
    department = document.getElementById("department");
    btnOKSelectedDepartment = document.getElementById(
        "btnOKSelectedDepartment"
    );
}
function initEvent() {
    btnOKSelectedDepartment.onclick = function(e) {
        let listSelect = document.querySelectorAll(`.checkDepartment:checked`);
        arrDepartment.length = 0;
        let name = "";
        for (const chk of listSelect) {
            arrDepartment.push(chk.dataset.id);
            name += chk.dataset.name + ",";
        }
        department.value = name;
        $("#modelSelectDepartment").modal("toggle");
    };

    selectDepartment.onclick = async function(e) {
        let result = await departmentApi.fetchDataWithoutTree();
        let html = "";
        result.forEach(item => {
            html += `<tr>
            <td><input type="checkbox" data-name="${item.name}" data-id="${item.id}" class="checkDepartment"/></td>
            <td>${item.name}</td>
            <td>${item.address}</td>
            <td>${item.phone}</td>
            </tr>`;
        });
        bodyTableDepartment.innerHTML = html;
        $("#modelSelectDepartment").modal("show");
    };
    send.onclick = async function() {
        let data = getValue();
        let result = await noticeApi.save(data);
        if (result.msg == "ok") {
            window.location.reload();
        } else {
            Swal.fire("Đã có lỗi xảy ra vui lòng kiểm tra lại", "Lỗi", "error");
        }
    };
}
async function initData() {
    loadData(1);
}

function getValue() {
    let formData = new FormData();
    formData.append("title", title.value);
    formData.append("to", JSON.stringify(arrDepartment));
    formData.append("content", content.value);
    for (var i = 0; i < file.files.length; i++) {
        let fileAttach = file.files[i];
        formData.append(`files[${i}]`, fileAttach);
    }
    return formData;
}
async function loadData(page) {
    let result = await noticeApi.fetch(page);
    let html = "";
    let index = 1;
    result.data.forEach(element => {
        html += `<tr>
        <td>${index}</td>
        <td>${element.title}</td>
        <td>${element.unit}</td>
        <td><button data-id="${element.id}" class="btn btn-sm btn-danger btnDelete"> <i class="fa fa-trash" aria-hidden="true"></i></button>
        <button data-id="${element.id}" class="btn btn-sm btn-info btnView"><i class="fas fa-eye"></i></button>
        </td>
        </tr>`;
        index++;
    });
    bodyTableNotice.innerHTML = html;

    let deleteButton = document.getElementsByClassName("btnDelete");

    for (const btn of deleteButton) {
        btn.onclick = async function(e) {
            let result = await noticeApi.del(btn.dataset.id);
            if (result.msg == "ok") {
                window.location.reload();
            } else {
                Swal.fire(
                    "Đã có lỗi xảy ra vui lòng thử lại",
                    "Có lỗi",
                    "error"
                );
            }
        };
    }

    let view = document.getElementsByClassName("btnView");

    for (const viewButton of view) {
        viewButton.onclick = function(e) {
            window.location = `viewNotice/${viewButton.dataset.id}/detail`;
        };
    }
    showPagination("#paginationTable", result.total, loadData);
}
