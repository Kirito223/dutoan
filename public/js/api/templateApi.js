import axios from "./axiosClient.js";
const templateApi = {
    fetch: async function(page) {
        let result = await axios.get("template/all?page=" + page);
        return result;
    },
    fetchAll: async function() {
        let result = await axios.get("template/all?all=true");
        return result;
    },
    save: async function(data) {
        let result = await axios.post("template/store", data);
        return result;
    },
    edit: async function(data, id) {
        let result = await axios.put("template/update/" + id, data);
        return result;
    },
    del: async function(id) {
        let result = await axios.delete("template/destroy/" + id);
        return result;
    },
    getDataEdit: async function(id) {
        let result = await axios.get("/template/edit/" + id);
        return result;
    },
    getTemplate: async function(template) {
        let result = await axios.get("template/get/" + template);
        return result;
    }
};

export default templateApi;
