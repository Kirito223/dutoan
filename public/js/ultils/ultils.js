import locationApi from "../api/locationApi.js";

export async function provinceSelectbox(
    provinceContainer = null,
    action = null
) {
    if (provinceContainer != null) {
        let province = await locationApi.province();
        provinceContainer.innerHTML = "";

        let optionNull = document.createElement("option");
        optionNull.setAttribute("value", "");
        optionNull.textContent = "Chọn tỉnh";
        provinceContainer.appendChild(optionNull);

        province.forEach(element => {
            let option = document.createElement("option");
            option.setAttribute("value", element.matp);
            option.textContent = element.name;
            provinceContainer.appendChild(option);
        });

        provinceContainer.onchange = action;
    }
}
export async function districtSelectbox(
    districtContainer = null,
    provinceId = null,
    action = null
) {
    if (districtContainer != null) {
        let district = await locationApi.district(provinceId);
        districtContainer.innerHTML = "";
        let optionNull = document.createElement("option");
        optionNull.setAttribute("value", "");
        optionNull.textContent = "Chọn quận/huyện";
        districtContainer.appendChild(optionNull);
        district.forEach(element => {
            let option = document.createElement("option");
            option.setAttribute("value", element.maqh);
            option.textContent = element.name;
            districtContainer.appendChild(option);
        });

        districtContainer.onchange = action;
    }
}

export async function communeSelectbox(communeContainer = null, district) {
    if (communeContainer != null) {
        let commune = await locationApi.commune(district);
        communeContainer.innerHTML = "";
        let optionNull = document.createElement("option");
        optionNull.setAttribute("value", "");
        optionNull.textContent = "Chọn phường/xã";
        communeContainer.appendChild(optionNull);
        commune.forEach(element => {
            let option = document.createElement("option");
            option.setAttribute("value", element.xaid);
            option.textContent = element.name;
            communeContainer.appendChild(option);
        });
    }
}
export function showPagination(container, lastPage, callback) {
    $(container).twbsPagination({
        totalPages: lastPage,
        visiblePages: 5,
        nextClass: "hidden",
        prevClass: "hidden",
        lastClass: "hidden",
        firstClass: "hidden",
        onPageClick: function(event, page) {
            callback(page);
        }
    });
}
export function showError(error) {
    for (const [key, value] of Object.entries(error)) {
        let errElement = document.querySelector(`small[name="${key}"]`);
        value.forEach(err => {
            let p = document.createElement("p");
            p.textContent = `*${err}`;
            errElement.appendChild(p);
        });
    }

    let clear = setTimeout(() => {
        for (const [key, value] of Object.entries(error)) {
            let errElement = document.querySelector(`small[name="${key}"]`);
            errElement.innerHTML = "";
        }
        clearTimeout(clear);
    }, 6000);
}
