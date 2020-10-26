import departmentApi from "../../api/departmentApi.js";
import {
    provinceSelectbox,
    districtSelectbox,
    communeSelectbox
} from "../../ultils/ultils.js";
var name,
    address,
    commune,
    district,
    province,
    phone,
    email,
    btnSave,
    tableDepartment,
    parentDepartment,
    btnAddNew,
    btnUpdate,
    infomationAccount,
    btnExit;
var currentPage = 1;
var edit;
var htmlTable = "";
var htmlSelectboxDepartment = "";
var arrResult = [];
window.onload = function() {
    initControl();
    loadData();
    initEvent();
};

function initControl() {
    name = document.getElementById("name");
    address = document.getElementById("address");
    commune = document.getElementById("commune");
    district = document.getElementById("district");
    province = document.getElementById("province");
    phone = document.getElementById("phone");
    email = document.getElementById("email");
    btnSave = document.getElementById("btnSave");
    tableDepartment = document.getElementById("tableDepartment");
    parentDepartment = document.getElementById("parentDepartment");
    btnAddNew = document.getElementById("btnAddNew");
    btnUpdate = document.getElementById("btnUpdate");
    infomationAccount = document.getElementById("infomationAccount");
    btnExit = document.getElementById("btnExit");
    provinceSelectbox(province, function(e) {
        districtSelectbox(district, e.target.value, function(f) {
            let value = f.target.value;
            communeSelectbox(commune, value);
        });
    });
}
function loadData() {
    progressAll();
}
async function progressAll() {
    await Promise.all([getPage(currentPage), getDepartment()]);
}

async function getDepartment() {
    let result = await departmentApi.getData();
    parentDepartment.innerHTML = "";
    htmlSelectboxDepartment = "";
    showDepartment(result);
    parentDepartment.innerHTML =
        '<option value="" selected data-path="">Không có</option>' +
        htmlSelectboxDepartment;
}

function showDepartment(result) {
    for (const item in result) {
        if (result[item].hasOwnProperty("children")) {
            let element = result[item];
            htmlSelectboxDepartment += `<option value="${element.id}" data-path="${element.path}">${element.name}</option>`;
            showDepartment(result[item].children);
        } else {
            let element = result[item];
            htmlSelectboxDepartment += `<option value="${element.id}" data-path="${element.path}">${element.name}</option>`;
        }
    }
}

function showTable(result, index) {
    for (const item in result) {
        if (result[item].hasOwnProperty("children")) {
            let element = result[item];
            let dataParent =
                element.parentDepartment == null
                    ? ""
                    : ` data-tt-parent-id=${element.parentDepartment}`;
            htmlTable += `<tr data-tt-id="${element.id}" ${dataParent}>
        <td>${index}</td>
        <td>${element.name}</td>
        <td>${element.address}</td>
        <td>${element.phone}</td>
        <td>${element.email}</td>
        <td class="tdBox">
        <button data-ttId=${element.id} class="btn btn-sm btn-info btnEdit" ><i class="fas fa-edit fa-sm fa-fw"></i> Sửa</button>
        <a href="/account/index/${element.id}"  class="btn btn-sm btn-warning" ><i class="fas fa-key"></i> Quản lý tài khoản</a>
        <button data-id="${element.id}" class="btn btn-sm btn-danger btnDelelete"><i class="fas fa-trash fa-sm fa-fw"></i> Xóa</button>
        </td>
        </tr>`;
            arrResult.push(element);
            index++;
            showTable(result[item].children, index);
        } else {
            let element = result[item];
            let dataParent =
                element.parentDepartment == null
                    ? ""
                    : ` data-tt-parent-id=${element.parentDepartment}`;
            htmlTable += `<tr data-tt-id="${element.id}" ${dataParent}>
                    <td>${index}</td>
                    <td>${element.name}</td>
                    <td>${element.address}</td>
                    <td>${element.phone}</td>
                    <td>${element.email}</td>
                    <td class="tdBox">
                    <button data-ttId=${element.id} class="btn btn-sm btn-info btnEdit" ><i class="fas fa-edit fa-sm fa-fw"></i> Sửa</button>
                    <a href="/account/index/${element.id}"  class="btn btn-sm btn-warning" ><i class="fas fa-key"></i> Quản lý tài khoản</a>
                    <button data-id="${element.id}" class="btn btn-sm btn-danger btnDelelete"><i class="fas fa-trash fa-sm fa-fw"></i> Xóa</button>
                    </td>
                    </tr>`;
            arrResult.push(element);
            index++;
        }
    }
}

async function getPage(page) {
    let result = await departmentApi.getData(page);
    tableDepartment.innerHTML = "";
    showTable(result, 1);
    tableDepartment.innerHTML = htmlTable;
    $("#tableDepartments").treetable({
        expandable: true
    });

    let btnDelete = document.getElementsByClassName("btnDelelete");
    for (const element of btnDelete) {
        element.onclick = function(e) {
            delDepartment(element.dataset.id);
        };
    }

    let tr = document.getElementsByClassName("btnEdit");

    for (const trElement of tr) {
        trElement.onclick = async function(e) {
            btnSave.classList.add("hidden");
            btnUpdate.classList.remove("hidden");
            let id = trElement.dataset.ttid;
            let index = arrResult.find(x => x.id == id);
            name.value = index.name;
            address.value = index.address;
            province.value =
                index.province > 9 ? index.province : "0" + index.province;

            await districtSelectbox(district, province.value);

            let districtValue;
            if (index.district < 9) {
                districtValue = "00" + index.district;
            }
            if (index.district > 9) {
                districtValue = "0" + index.district;
            }
            if (index.district > 99) {
                districtValue = index.district;
            }
            district.value = districtValue;

            await communeSelectbox(commune, district.value);
            let communeValue;
            if (index.commune < 9) {
                communeValue = "0000" + index.commune;
            }
            if (index.commune > 9) {
                communeValue = "000" + index.commune;
            }
            if (index.commune > 99) {
                communeValue = "00" + index.commune;
            }
            if (index.commune > 999) {
                communeValue = index.commune;
            }
            commune.value = communeValue;
            phone.value = index.phone;
            email.value = index.email;
            parentDepartment.value = index.parentDepartment;
            edit = index.id;
        };
    }
}

function getValue() {
    return {
        name: name.value,
        address: address.value,
        commune: commune.value,
        district: district.value,
        province: province.value,
        phone: phone.value,
        email: email.value,
        parentDepartment: parentDepartment.value
    };
}

function initEvent() {
    btnExit.onclick = function(e) {
        changePassword = 0;
        username.value = null;
        password.value = null;
        btnSavePassword.classList.add("hidden");
        btnExit.classList.add("hidden");
        btnAddNew.classList.remove("hidden");
    };

    btnSave.onclick = function(e) {
        let department = getValue();
        saveDepartment(department);
    };

    btnUpdate.onclick = function() {
        let department = getValue();
        updateDepartment(department, edit);
    };

    btnAddNew.onclick = function() {
        btnSave.classList.remove("hidden");
        infomationAccount.classList.remove("hidden");
        name.value = null;
        address.value = null;
        commune.value = null;
        district.value = null;
        province.value = null;
        phone.value = null;
        email.value = null;
        parentDepartment.value = "";
        username.value = null;
        password.value = null;
        edit = null;
    };
}
async function saveDepartment(data) {
    let result = await departmentApi.save(data);
    if (result.msg == "ok") {
        window.location.reload();
    } else {
        Swal.fire("Đã có lỗi xảy ra vui lòng kiểm tra lại", "Lỗi", "error");
    }
}
async function updateDepartment(data, id) {
    let result = await departmentApi.edit(data, id);
    if (result.msg == "ok") {
        window.location.reload();
    } else {
        Swal.fire("Đã có lỗi xảy ra vui lòng kiểm tra lại", "Lỗi", "error");
    }
}
async function delDepartment(id) {
    let result = await departmentApi.delete(id);
    if (result.msg == "ok") {
        window.location.reload();
    } else {
        Swal.fire("Đã có lỗi xảy ra vui lòng kiểm tra lại", "Lỗi", "error");
    }
}
