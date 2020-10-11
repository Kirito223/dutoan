import axiosClient from "./axiosClient.js";
const evaluationApi = {
    getData: async function(page) {
        let result = await axiosClient.get(`evaluation/all`);
        return result;
    },

    save: async function(data) {
        let result = await axiosClient.post(`evaluation/store`, data);
        return result;
    },
    edit: async function(data, id) {
        let result = await axiosClient.put(`evaluation/update/${id}`, data);
        return result;
    },
    delete: async function(id) {
        let result = await axiosClient.delete(`evaluation/destroy/${id}`);
        return result;
    }
};
export default evaluationApi;
