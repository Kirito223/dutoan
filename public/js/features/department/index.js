import departmentApi from "../../api/departmentApi.js";
import {
    provinceSelectbox,
    districtSelectbox,
    communeSelectbox,
    showTree
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
    parentDepartment = document.getElementById("parentDepartment");
    provinceSelectbox(province, function(e) {
        districtSelectbox(district, e.target.value, function(f) {
            let value = f.target.value;
            communeSelectbox(commune, value);
        });
    });
}
function loadData() {
    getPage(currentPage);
    getDepartment();
}

async function getDepartment() {
    let result = await departmentApi.getData();
    result = showTree(result);
    parentDepartment.innerHTML = "";
    let html = "";
    result.forEach(element => {
        html += `<option value="${element.id}" data-path="${element.path}">${element.name}</option>`;
    });
    parentDepartment.innerHTML =
        '<option value="" selected data-path="">Không có</option>' + html;
}

async function getPage(page) {
    let result = await departmentApi.getData(page);
    result = showTree(result);
    tableDepartment.innerHTML = "";
    let html = "";
    let index = 1;
    result.forEach(element => {
        let tdName = document.createElement("td");
        tdName.textContent = element.name;

        html += `<tr>
        <td>${index}</td>
        <td>${element.name}</td>
        <td>${element.address}</td>
        <td>${element.phone}</td>
        <td>${element.email}</td>
        <td><button class="btn btn-sm btn-danger"><i class="fas fa-trash fa-sm fa-fw"></i></button></td>
        </tr>`;
        index++;
    });
    tableDepartment.innerHTML = html;
}
// function showTree(tree) {
//     for (const item in tree) {
//         if (tree[item].hasOwnProperty("children")) {
//             // console.log(tree[item]);
//             showTree(tree[item].children);
//         } else {
//             result.push(tree[item]);
//         }
//     }
// }
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
            parentDepartment: parentDepartment.value,
            username: username.value,
            password: password.value
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
