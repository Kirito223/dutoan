import axios from "./axiosClient.js";
const templateApi = {
    fetch: async function(page) {
        let result = await axios.get("template/all?page=" + page);
        return result;
    },
    save: async function(data) {
        let result = await axios.post("template/store", data);
        return result;
    },
    edit: async function(data, id) {
        let result = await axios.post("template/update/" + id, data);
        return result;
    },
    del: async function(id) {
        let result = await axios.delete("template/destroy/" + id);
        return result;
    }
};

export default templateApi;
