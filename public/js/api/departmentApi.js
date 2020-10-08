import axiosClient from "./axiosClient.js";
const departmentApi = {
    getData: async function(page) {
        let result = await axiosClient.get(`department/all`);
        return result;
    },
    save: async function(data) {
        let result = await axiosClient.post(`department/store`, data);
        return result;
    },
    edit: async function(data) {
        let result = await axiosClient.put(
            `department/update/${data.id}`,
            data
        );
        return result;
    },
    delete: async function(id) {
        let result = await axiosClient.delete(`department/destroy/${id}`, data);
        return result;
    }
};
export default departmentApi;
