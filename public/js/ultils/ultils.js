import locationApi from "../api/locationApi.js";

export async function provinceSelectbox(
    provinceContainer = null,
    action = null
) {
    if (provinceContainer != null) {
        let province = await locationApi.province();
        provinceContainer.innerHTML = "";
        province.forEach(element => {
            let option = document.createElement("option");
            option.setAttribute("value", element.matp);
            option.textContent = element.name;
            provinceContainer.appendChild(option);
        });

        provinceContainer.value = province[0].matp;
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
        district.forEach(element => {
            let option = document.createElement("option");
            option.setAttribute("value", element.maqh);
            option.textContent = element.name;
            districtContainer.appendChild(option);
        });
        districtContainer.value = district[0].maqh;
        districtContainer.onchange = action;
    }
}

export async function communeSelectbox(communeContainer = null, district) {
    if (communeContainer != null) {
        let commune = await locationApi.commune(district);
        communeContainer.innerHTML = "";
        commune.forEach(element => {
            let option = document.createElement("option");
            option.setAttribute("value", element.xaid);
            option.textContent = element.name;
            communeContainer.appendChild(option);
        });
        communeContainer.value = commune[0].xaid;
    }
}
