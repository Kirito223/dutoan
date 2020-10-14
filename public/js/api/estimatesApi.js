import axios from "./axiosClient.js";
var estimatesApi = {
    fetch: async function(page) {
        let result = await axios.get("estimate/all?page=" + page);
        return result;
    },

    save: async function(data) {
        let result = await axios.post("estimate/store", data);
        return result;
    },
    edit: async function(data, id) {
        let result = await axios.put("estimate/update/" + id, data);
        return result;
    },
    del: async function(id) {
        let result = await axios.delete("estimate/destroy/" + id);
        return result;
    }
};
export default estimatesApi;
