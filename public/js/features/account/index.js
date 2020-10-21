var tableAccount,
    btnAddNew,
    department,
    btnSaveAccount,
    username,
    password,
    name,
    role;
import accountApi from "../../api/accountApi.js";
import { showPagination } from "../../ultils/ultils.js";
import roleApi from "../../api/roleApi.js";
var arrAccount = [];
var editId = null;
window.onload = function() {
    initControl();
    initData();
    initEvent();
};
function initControl() {
    tableAccount = document.getElementById("tableAccount");
    btnAddNew = document.getElementById("btnAddNew");
    department = document.getElementById("department");
    btnSaveAccount = document.getElementById("btnSaveAccount");
    username = document.getElementById("username");
    password = document.getElementById("password");
    name = document.getElementById("name");
    role = document.getElementById("role");
}

function initData() {
    Promise.all([loadData(1), loadRole()]);
}

function getData() {
    let chkRole = document.querySelectorAll(`.chkRole:checked`);
    let arrRole = [];
    for (const chk of chkRole) {
        arrRole.push(chk.value);
    }
    return {
        username: username.value,
        password: password.value,
        name: name.value,
        department: department.value,
        role: JSON.stringify(arrRole)
    };
}

async function loadData(page) {
    let result = await accountApi.getData(page, department.value);
    let html = "";
    let index = 1;
    result.data.forEach(account => {
        html += `<tr>
        <td>${index}</td>
        <td>${account.name}</td>
        <td>${account.username}</td>
        <td><button data-id="${account.id}" class="btn btn-info btn-sm btnEdit"> <i class="fas fa-trash fa-sm fa-fw"></i> Sửa</button>
        <button data-id="${account.id}" class="btn btn-danger btn-sm btnDel"> <i class="fas fa-trash fa-sm fa-fw"></i> Xóa</button>
        </td>
        </tr>`;
        arrAccount.push(account);
        index++;
    });

    tableAccount.innerHTML = html;

    let btnEdit = document.getElementsByClassName("btnEdit");
    for (const btn of btnEdit) {
        btn.onclick = function() {
            let index = arrAccount.findIndex(x => x.id == btn.dataset.id);
            name.value = arrAccount[index].name;
            username.value = arrAccount[index].username;
            password.value = arrAccount[index].password;
            editId = arrAccount[index].id;
            let roles = arrAccount[index].roleaccount;
            let clear = document.getElementsByClassName("chkRole");
            for (const chk of clear) {
                chk.checked = false;
            }
            roles.forEach(element => {
                document.querySelector(
                    `.chkRole[value="${element.role}"]`
                ).checked = true;
            });

            showModal();
        };
    }

    let btnDel = document.getElementsByClassName("btnDel");
    for (const btn of btnDel) {
        btn.onclick = function() {
            del(btn.dataset.id);
        };
    }
    showPagination("#paginationTable", result.last_page, loadData);
}

async function loadRole() {
    let result = await roleApi.getRole();
    let html = "";
    result.forEach(item => {
        html += `<label class="form-check-label">
        <input class="form-check-input chkRole" type="checkbox"  value="${item.id}"> ${item.name}
    </label>`;
    });
    role.insertAdjacentHTML("beforeend", html);
}

function showModal() {
    $("#modelAddNew").modal("show");
}
function closeModal() {
    $("#modelAddNew").modal("toogle");
}
function initEvent() {
    btnAddNew.onclick = function(e) {
        showModal();
    };

    btnSaveAccount.onclick = function() {
        if (editId == null) {
            save();
        } else {
            edit();
        }
    };
}

async function del(id) {
    let result = await accountApi.delete(id);
    if (result.msg == "ok") {
        window.location.reload();
    } else {
        Swal.fire(
            "Đã xảy ra lỗi vui lòng thử lại sau",
            "Đã xảy ra lỗi",
            "error"
        );
    }
}

async function edit() {
    let data = getData();
    let result = await accountApi.edit(data, editId);
    if (result.msg == "ok") {
        window.location.reload();
    } else {
        Swal.fire(result.data.name[0], result.data.name[0], "error");
    }
}
async function save() {
    let data = getData();
    let result = await accountApi.save(data);
    if (result.msg == "ok") {
        window.location.reload();
    } else {
        Swal.fire(result.data.name[0], result.data.name[0], "error");
    }
}
