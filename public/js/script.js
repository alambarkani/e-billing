document.addEventListener('DOMContentLoaded', (ev) =>{
    const roleSelect = document.getElementById('role');

    const customer_id = document.getElementById('customer_id_block');

    roleSelect.addEventListener('change', (ev) =>{
        if(roleSelect.value === 'customer' ){
            customer_id.classList.add('block');
            customer_id.classList.remove('hidden');
        }else{
            customer_id.classList.add('hidden');
            customer_id.classList.remove('block');
        }
    })
})