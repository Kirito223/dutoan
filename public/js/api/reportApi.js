import axiosClient from "./axiosClient.js";
const reportApi = {
    getData: async function(page, id) {
        let result = await axiosClient.get(`report/all?page=${page}`);
        return result;
    },

    save: async function(data) {
        let result = await axiosClient.post(`report/store`, data);
        return result;
    },
    edit: async function(data, id) {
        let result = await axiosClient.put(`report/update/${id}`, data);
        return result;
    },
    delete: async function(id) {
        let result = await axiosClient.delete(`report/destroy/${id}`);
        return result;
    },
    getEdit: async function(id) {
        let result = await axiosClient.get(`report/show/${id}`);
        return result;
    },
    getListApproval: async function(page) {
        let result = await axiosClient.get(`report/listApproval?page=${page}`);
        return result;
    },
    approval: function(id) {
        let result = axiosClient.get(`report/approvalReport/${id}`);
        return result;
    },
    reject: function(id) {
        let result = axiosClient.get(`report/rejectReport/${id}`);
        return result;
    },
    additional: function(id, data) {
        let result = axiosClient.post(`report/additionalReport/${id}`, data);
        return result;
    }
};
export default reportApi;
