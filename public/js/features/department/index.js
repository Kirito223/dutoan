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
    username,
    password,
    btnSave,
    tableDepartment,
    pages,
    nextPage,
    perviousPage,
    parentDepartment;
var currentPage = 1;
var edit;

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
    username = document.getElementById("username");
    password = document.getElementById("password");
    btnSave = document.getElementById("btnSave");
    tableDepartment = document.getElementById("tableDepartment");
    pages = document.getElementById("page");
    parentDepartment = document.getElementById("parentDepartment");
    provinceSelectbox(province, function(e) {
        districtSelectbox(district, e.target.value, function(f) {
           let value = f.target.value;
            communeSelectbox(commune,value);
        });
    });
}
function loadData() {
    getPage(currentPage);
    getDepartment();
}

async function getDepartment() {
    let result = await departmentApi.getData();
    parentDepartment.innerHTML = "";
    let html = "";
    let index = 1;
    result.forEach(element => {
        html += `<option value="${element.id}" data-path="${element.path}">${element.name}</option>`;
    });
    parentDepartment.innerHTML =
        '<option value="" data-path="">Không có</option>' + html;
}

async function getPage(page) {
    let result = await departmentApi.getData(page);
    tableDepartment.innerHTML = "";
    let html = "";
    let index = 1;
    result.data.forEach(element => {
        html += `<tr>
        <td>${index}</td>
        <td>${element.name}</td>
        <td>${element.address}</td>
        <td>${element.phone}</td>
        <td>${element.email}</td>
        </tr>`;
    });
    tableDepartment.innerHTML = html;
    pages.value = currentPage;
}
function initEvent() {
    btnSave.onclick = function(e) {
        let department = {
            name: name.value,
            address: address.value,
            commune: commune.value,
            district: district.value,
            province: province.value,
            phone: phone.value,
            email: email.value,
            parentDepartment: parentDepartment.value
        };
        saveDepartment(department);
    };
}
async function saveDepartment(data) {
    let result = await departmentApi.save(data);
    if (result.msg == "ok") {
        window.location.reload();
    }
}
