import axiosClient from "./axiosClient.js";
const reportApi = {
    getData: async function(page, id) {
        let result = await axiosClient.get(`report/all/${id}?page=${page}`);
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
    }
};
export default reportApi;
