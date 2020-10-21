import axios from "./axiosClient.js";
const roleApi = {
    getRole: async function() {
        let result = await axios.get("/role/all");
        return result;
    }
};
export default roleApi;
