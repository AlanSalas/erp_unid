document.addEventListener('DOMContentLoaded', async () => {

    const employee = document.querySelector('#employee')

    const userId = document.querySelector('#user').value

    const employeeId = document.querySelector('#employeeId')

    const vacationSupervisor = document.querySelector('#vacationSupervisor')

    const table = document.querySelector('#table-vac')

    const employeeData =
        await axios.get(`http://${window.location.hostname}/erp_modulos/rh/Api/employees/${employee.value}`)
        .then(response => {
            return response.data
        })
        .catch(e => {
            console.log(e)
            return null
        })


    if(employeeData){

        if(!employeeData.recruitmentDate){
            window.location = `http://${window.location.hostname}/403.html`
        }

        employeeId.value = `${employeeData.lastname.concat(' ',  employeeData.mothersLastname, ' ', employeeData.name)} (${employeeData.number })`

        await axios.get(`http://${window.location.hostname}/erp_modulos/rh/Api/vacations?user=${userId}`)
            .then(response => {
                const rows = response.data.map((data, id) => (
                    `<tr style="text-align: justify">
                 <th scope="row" style="text-align: center" id=${id}>${id + 1}</th>
                 <td data=${data.id}>${data.employeeLastname.concat(' ',  data.employeeMothersLastname, ' ', data.employeeName)}</td>
                 <td data=${data.id}>${data.vacationFrom}</td>
                 <td data=${data.id}>${data.vacationTo}</td>
                 <td data=${data.id}>${data.departmentName}</td>
                 <td> 
                 <button class="btn btn-sm btn-primary" id="btn-edit" data-toggle="modal" data-name="${data.positionName}" data-tip="tooltip" title="Editar" data-target="#modal-edit" data=${data.id}><i class="fas fa-edit"></i></button>
                 <button class="btn btn-sm btn-danger" id="btn-delete" data-toggle="modal" data-name="${data.positionName}" data-tip="tooltip" title="Eliminar" data-target="#modal-delete" data=${data.id}><i class="fas fa-trash-alt"></i></button>
                 </td>
                 </tr>`
                ));
                table.innerHTML += rows.join('')
                $('#table-vac').bootstrapTable({
                    pagination: true,
                    search: true
                })
                $('[data-tip="tooltip"]').tooltip()
            })
            .catch(e => {
                console.log(e)
            })

        const availableDays = (employeeData) => {
            const edate = new Date(employeeData.recruitmentDate)
            const eyear = new Date().getFullYear() - edate.getFullYear();

            if(eyear === 1){
                return eyear * 6
            }
            if(eyear > 1 && eyear < 5){
                return 6 + ((eyear - 1) * 2)
            }
            if(eyear >= 5){
                return 12 + (parseInt(eyear / 5) * 2)
            }
            return eyear
        }

        const available_days = document.querySelector('#availableDays')
        available_days.innerHTML = availableDays(employeeData)

        axios.get(`http://${window.location.hostname}/erp_modulos/rh/Api/employees?department=${employeeData.department}&supervisors=1`)
            .then(response => {
                const data = response.data

                const rows = data.map(option => {
                    if (option.id !== employeeData.id) {
                        return(`<option value="${option.id}">${option.lastname.concat(' ',  option.mothersLastname, ' ', option.name)} (${option.number})</option>`)
                    }
                })
                vacationSupervisor.innerHTML = rows.join('')
                $('#vacationSupervisor').selectpicker('refresh')
                $('#vacationSupervisor').selectpicker({
                    liveSearch: true,
                    liveSearchNormalize: true,
                    size: 5
                });

            })
            .catch(e => {
                console.log(e)
            })

        $('#vacationDate').daterangepicker({
            isInvalidDate: function(date) {
                return (date.day() == 0 || date.day() == 6 );
            },
            maxSpan: {
                "days": availableDays(employeeData)
            },
            minDate: moment()
        });
    }

    const submit = document.querySelector('#submit')

    const form =  document.querySelector('#form-vac')

    submit.addEventListener('click', event => {
        const form_data = new FormData(form)
        const data = Object.fromEntries(form_data)
        data.employeeId = employeeData['id']
        data.vacationRequested = new Date().toISOString().slice(0,10)
        data.vacationFrom =  $("#vacationDate").data('daterangepicker').endDate.format('YYYY-MM-DD')
        data.vacationTo =  $("#vacationDate").data('daterangepicker').endDate.format('YYYY-MM-DD')
        data.vacationUser = userId

        console.log(data)

        axios.post(`http://${window.location.hostname}/erp_modulos/rh/Api/vacations`, data)
            .then(response => {
                if (response.data === 1) {
                    location.reload()
                }
            })
            .catch(e => {
                handleErrors({form:'form-pos', data:e.response.data})
            })
    })

    //const employeeData = { ...response.data }
    /*
    function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        }
     */

}, true)