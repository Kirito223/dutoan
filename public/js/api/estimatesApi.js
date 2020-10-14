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
    },
    send: async function(data) {
        let result = await axios.post("/estimate/send", data);
        return result;
    },
    listApproval: async function(page) {
        let result = await axios.get("/estimate/listApproval?page=" + page);
        return result;
    },
    viewDetail: async function(id) {
        let result = await axios.get("/estimate/getEstimateDetail/" + id);
        return result;
    },
    approval: async function(id) {
        let result = await axios.get("/estimate/approval/" + id);
        return result;
    },
    reject: async function(id) {
        let result = await axios.get("/estimate/reject/" + id);
        return result;
    }
};

export default estimatesApi;
