import axios from "./axiosClient.js";
const locationApi = {
    commune: async function(district) {
        let result = await axios.get("commune/" + district);
        return result.data;
    },
    district: async function(province) {
        let result = await axios.get("district/" + province);
        return result.data;
    },
    province: async function() {
        let result = await axios.get("province");
        return result.data;
    }
};

export default locationApi;
