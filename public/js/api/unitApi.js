import axiosClient from "./axiosClient.js";
const unitApi = {
    getData: async function(page) {
        let result = await axiosClient.get(`unit/all?page=${page}`);
        return result;
    },

    save: async function(data) {
        let result = await axiosClient.post(`unit/store`, data);
        return result;
    },
    edit: async function(data, id) {
        let result = await axiosClient.put(`unit/update/${id}`, data);
        return result;
    },
    delete: async function(id) {
        let result = await axiosClient.delete(`unit/destroy/${id}`);
        return result;
    },
    getAll: async function() {
        let result = await axiosClient.get(`unit/all?all=1`);
        return result;
    }
};
export default unitApi;
