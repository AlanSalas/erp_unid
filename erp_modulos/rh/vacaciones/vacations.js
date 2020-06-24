document.addEventListener('DOMContentLoaded', async () => {

    const employeeId = document.querySelector('#employeeId')

    if(employeeId){
        axios.get(`http://${window.location.hostname}/erp_modulos/rh/Api/employees/${employeeId.value}`)
            .then(response => {
                console.log(response.data)
            })
            .catch(e => {
                console.log(e)
            })
    }

}, true)