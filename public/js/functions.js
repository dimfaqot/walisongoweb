 // post js
 async function post(url = '', data = {}) {
    loading(true);
    const response = await fetch(baseUrl+'/'+url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    });
    loading(false);
    return response.json(); // parses JSON response into native JavaScript objects
}




// req bebas
// jika req==null maka stuck, jika tidak maka reload
const sukses=(req=false)=>{
    if(req===false){
        $('.sukses').show();
        setTimeout(() => {
            $('.sukses').fadeOut();
        }, 1200);

    }else{
        $('.sukses').show();
        setTimeout(() => {
            $('.sukses').fadeOut();
        }, 1200);
    
        setTimeout(() => {
            location.reload();
        }, 1200);
    }
}

// req berisi pesan respon dari server
// jika null maka 'Something is wrong!.' jika tidak maka pesan dari respon server
const gagal=(req=undefined)=>{
    $('.gagal').show();

    $('.gagal div.toast-body').text((req===undefined)?'Something is wrong!.':req);

    $(document).on('click', '.btnclose', function(e) {
        e.preventDefault();
        $('.gagal').fadeOut();
    });
}



// req berisi bebas
// jika null maka loading ditampilkan, jika tidak maka loading disembunyikan
const loading=(req=true)=>{
    if(req===true){
        $('.waiting').show()
    }else{
        $('.waiting').fadeOut()
    }
}

// tipe delete biasa
// hanya butuh id
const deletebiasa = (id,idmenu,tabel, colshow, url) => {

    post(url, {
        id,idmenu,tabel, colshow
    })
    .then(res => {

        if (res.status == 200) {
            $('#modaledit'+id).modal('hide');
            datashowjs(res.data.format, colshow, res.data.props,res.data.data.data);
            sukses(res.reload);
        } else {
            gagal(res.message)
        }
        
     
    })
}


const is_id=(col, text)=>{
    let data=col.split("_");
        [last] = data.slice(-1);
    if(last=='id'){
       let val=text.split(" ");
       return val[0];
    }else{
        return text
    }
}

const rmspace=(text)=>{

    return text.replace(/\s+/g, '');
}
const replacestrip=(text)=>{
    let exp=text.split('_');
    let res=text;
    if(exp.length>1){
        res=firstwordupcase(exp[0]+' '+exp[1]);
    }
    return res;
}
const replacespace=(text)=>{

    return text.replace(/\s+/g, '_');
}

function replacetext(find, replace,str) {
    var escapedFind=find.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
    return str.replace(new RegExp(escapedFind, 'g'), replace);
}

const firstwordupcase=(str)=>{
    var splitStr = str.toLowerCase().split(' ');
    for (var i = 0; i < splitStr.length; i++) {
        // You do not need to check if i is larger than splitStr length, as your for does that for you
        // Assign it back to the array
        splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
    }
    // Directly return the joined string
    return splitStr.join(' '); 
}




const singkatnama=(nama)=>
{
    exp = nama.split(' ');

    res = nama;

    if (exp.length == 2) {
        if (exp[0] == "Muhammad" || exp[0] == "Muhamad" || exp[0] == "Muhamat" || exp[0] == "Muhammat") {
            res = "M. " + exp[1];
        } else if (exp[0] == "Ahmad" || exp[0] == "Ahmat") {
            res = "A. " + exp[1];
        } else if (exp[0] == "Abdul") {
            res = "A. " + exp[1];
        }
    }
    if (exp.length == 3) {
        if (exp[0] == "Muhammad" || exp[0] == "Muhamad" || exp[0] == "Muhamat" || exp[0] == "Muhammat") {
            res = "M. " + exp[1] + ' ' + exp[2];
        } else if (exp[0] == "Ahmad" || exp[0] == "Ahmat") {
            res = "A. " + exp[1] + ' ' + exp[2];
        } else if (exp[0] == "Abdul") {
            res = "A. " + exp[1] + ' ' + exp[2];
        } else {
            res = exp[0] + ' ' + exp[1] + ' ' + exp[2].charAt(0) + '.';
        }
    }

    if (exp.length == 4) {
        if (exp[0] == "Muhammad" || exp[0] == "Muhamad" || exp[0] == "Muhamat" || exp[0] == "Muhammat") {
            res = "M. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '.';
        } else if (exp[0] == "Ahmad" || exp[0] == "Ahmat") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '.';
        } else if (exp[0] == "Abdul") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '.';
        } else {
            res = exp[0] + ' ' + exp[1] + ' ' + exp[2].charAt(0) + '. ' + exp[3].charAt(0) + '.';
        }
    }

    if (exp.length == 5) {
        if (exp[0] == "Muhammad" || exp[0] == "Muhamad" || exp[0] == "Muhamat" || exp[0] == "Muhammat") {
            res = "M. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '.';
        } else if (exp[0] == "Ahmad" || exp[0] == "Ahmat") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '.';
        } else if (exp[0] == "Abdul") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '.';
        } else {

            res = exp[0] + ' ' + exp[1] + ' ' + exp[2].charAt(0) + '. ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '.';
        }
    }


    if (exp.length == 6) {
        if (exp[0] == "Muhammad" || exp[0] == "Muhamad" || exp[0] == "Muhamat" || exp[0] == "Muhammat") {
            res = "M. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '.';
        } else if (exp[0] == "Ahmad" || exp[0] == "Ahmat") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '.';
        } else if (exp[0] == "Abdul") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '.';
        } else {

            res = exp[0] + ' ' + exp[1] + ' ' + exp[2].charAt(0) + '. ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '.';
        }
    }
    if (exp.length == 7) {

        if (exp[0] == "Muhammad" || exp[0] == "Muhamad" || exp[0] == "Muhamat" || exp[0] == "Muhammat") {
            res = "M. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '. ' + exp[6].charAt(0) + '.';
        } else if (exp[0] == "Ahmad" || exp[0] == "Ahmat") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '. ' + exp[6].charAt(0) + '.';
        } else if (exp[0] == "Abdul") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '. ' + exp[6].charAt(0) + '.';
        } else {

            res = exp[0] + ' ' + exp[1] + ' ' + exp[2].charAt(0) + '. ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '. ' + exp[6].charAt(0) + '.';
        }
    }

    if (exp.length == 8) {

        if (exp[0] == "Muhammad" || exp[0] == "Muhamad" || exp[0] == "Muhamat" || exp[0] == "Muhammat") {
            res = "M. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '. ' + exp[6].charAt(0) + '. ' + exp[7].charAt(0) + '.';
        } else if (exp[0] == "Ahmad" || exp[0] == "Ahmat") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '. ' + exp[6].charAt(0) + '. ' + exp[7].charAt(0) + '.';
        } else if (exp[0] == "Abdul") {
            res = "A. " + exp[1] + ' ' + exp[2] + ' ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '. ' + exp[6].charAt(0) + '. ' + exp[7].charAt(0) + '.';
        } else {

            res = exp[0] + ' ' + exp[1] + ' ' + exp[2].charAt(0) + '. ' + exp[3].charAt(0) + '. ' + exp[4].charAt(0) + '. ' + exp[5].charAt(0) + '. ' + exp[6].charAt(0) + '. ' + exp[7].charAt(0) + '.';
        }
    }
    return res;
}

const selectdb=(order,label,format,data, id=null, datamulti)=>{
    let html='';
    if(data.utils.tema=='main'){
        html+='<a type="button" data-order="'+order+'" data-id="'+id+'" data-label="'+label+'" style="background-color:'+data.set.colors.danger.mid_dark+'; color:'+data.set.colortema.light+';font-size:'+data.set.font_size+'" class="list-group-item list-group-item-action text-center clearsearch"><i class="fa fa-trash-o"></i> Hapus pencarian</a>';
        if(data.data.length==0){
            html+='<a type="button" data-order="edit" data-label="'+label+'" style="background-color:'+data.set.colortema.light+'; color:'+data.set.colors.danger.mid_dark+';font-size:'+data.set.font_size+'" class="list-group-item list-group-item-action text-center"><i class="fa fa-minus-circle"></i> Data tidak ditemukan!.</a>';
        }else{
            for (let i = 0; i < data.data.length; i++) {
                html+='<button data-order="'+order+'"';
                let newdatamulti=[];
                if(format =='multi'){
                        let multiarr=datamulti.split(",");
                        for (let m = 0; m < multiarr.length; m++) {
                            let label=replacetext(" ", "", replacetext(".", "",$('input[name='+multiarr[m]+']').attr('placeholder')));
                            newdatamulti.push(label);
                            html+='data-'+label+'="'+data.data[i][multiarr[m].toLowerCase()]+'" ';
                        }
                    }
                html+='data-id="'+id+'" data-datamulti="'+newdatamulti.join(',')+'" data-format="'+format+'" data-coltext="'+data.data[i][data.coltext]+'" data-label="'+label+'" data-val="'+data.data[i][data.colsubmit]+'" type="button" style="background-color:'+data.set.colortema.secondary+';" class="list-group-item list-group-item-action insert">';
                    for (let d = 0; d < data.colshow.length; d++) {
                    html+=data.data[i][data.colshow[d]]+' ';
                    }
                html+='</button>';
            
            }

        }

    }
   $('.bodyselect'+order+label+(order=='edit'?id:'')).html(html);
}

const selectpreview=(data,cols,set,query)=>{
    // console.log(cols)
    let html='';
        html+='<a type="button" style="background-color:'+set.colors.danger.mid_dark+'; color:'+set.colortema.light+';font-size:'+set.font_size+'" class="list-group-item list-group-item-action text-center clearsearchpreview"><i class="fa fa-trash-o"></i> Hapus pencarian</a>';
        if(data.length==0){
            html+='<a type="button" style="background-color:'+set.colortema.light+'; color:'+set.colors.danger.mid_dark+';font-size:'+set.font_size+'" class="list-group-item list-group-item-action text-center"><i class="fa fa-minus-circle"></i> Data tidak ditemukan!.</a>';
        }else{
            for (let i = 0; i < data.length; i++) {
                html+='<button data-id="'+data[i].id+'" data-query="'+query+'" data-cols="'+cols.join(",")+'" type="button" style="background-color:'+set.colortema.secondary+';" ';
                for (let c = 0; c < cols.length; c++) {
                 
                    html+='data-'+cols[c]+'="'+data[i][cols[c]]+'"';
                    
                }
                html+=' class="list-group-item list-group-item-action insertpreview">';
                html+=data[i].nama
                html+='</button>';
            }

    }
   $('.bodyselectpreview').html(html);
   $('.bodyselectpreview').show();
}


const body = (order=null, val=null) => {

    post('dashboard/datashow', {
        'order':(order==null?'edit':order),
        'menu':mainMenu,
        'val':(val==null?'':val)
    })
    .then(res => {
        if ("dokumen" in res.data){
            dokumen(res.data.dokumen)
        }
    let data=res.data.data;
    let props=res.data.props;
    let colors=res.data.set.colors;
    let colortema=res.data.set.colortema;
    let html = '';

    if(res.data.utils.tema=='main'){
        if(data.length==0){
            html += '<div class="accordion-header d-grid px-2 py-3" id="panelsStayOpen-headingnull">';
            html += '<button style="border:none; background-color:transparent;" href="#" class="collapsed btnlists" aria-current="true" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsenull" aria-expanded="false" aria-controls="panelsStayOpen-collapse">';
            html += '<div class="d-flex justify-content-between" style="font-size:'+res.data.set.font_size+'">';
          
                html += '<div style="font-size:'+res.data.set.font_size+';color:'+colors.danger.mid_dark+'"><i class="fa fa-minus-circle"></i> Data tidak ditemukan!.</div>';    
            
            html += '</div>';
            html += '</button>';
            html += '</div>';
        }else{
            if(res.data.utils.print.length>0){
                html+='<div class="print d-grid gap-2 d-flex justify-content-center">';
                
                for (let p = 0; p < res.data.utils.print.length; p++) {
                    html += '<form action="'+baseUrl+'/prints/'+res.data.utils.print[p].controller+'" method="post" target="_blank">';
                    html += '<input type="hidden" name="controller" value="'+res.data.utils.print[p].controller+'">';
                    html += '<input type="hidden" name="tabel" value="'+res.data.utils.print[p].tabel+'">';
                    html += '<input type="hidden" name="menu" value="'+res.data.utils.menu+'">';
                    for (let d = 0; d < data.length; d++) {
                        html += '<input type="hidden" name="id[]" value="'+data[d].id+'">';
                    }
        
                    if(res.data.utils.print[p].format=='pdf'){
                    html += '<div class="print d-grid gap-2 px-2 d-flex justify-content-center" style="font-size:'+res.data.set.font_size+'">';
                        html+='<div class="form-check form-switch pt-1" style="font-size:'+res.data.set.font_size+'">';
                        html+='<input class="form-check-input" name="list" type="checkbox" role="switch" id="flexSwitchCheckChecked">';
                        html+='<label class="form-check-label" style="color:'+colortema.dark+';" for="flexSwitchCheckChecked">List</label>';
                        html+='</div>';
                        html+='<select name="orientasi" style="width:35%; font-size:'+res.data.set.font_size+'" class="form-select form-select-sm" aria-label=".form-select-sm example">';
                        html+='<option value="P" selected>Potrait</option>';
                        html+='<option value="L">Lanscape</option>';
                        html+='</select>';
                        html += '<input name="cols" style="width:18%; font-size:'+res.data.set.font_size+'" type="text" class="form-control form-control-sm" placeholder="Cols">';
                        html += '<input name="judul" type="text" style="font-size:'+res.data.set.font_size+'" class="form-control form-control-sm" placeholder="Judul">';
                        html += '</div>';
                        html+='<div class="print d-grid gap-2 d-flex justify-content-center">';
                    }
                    html += '<button type="submit" class="btn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+colortema.mid_light+'; color:'+colortema.dark+'">';
                    html += '<i class="'+res.data.utils.print[p].icon+'"></i> '+res.data.utils.print[p].menu+' '+res.data.utils.print[p].format+'';
                    html += '</button>';
                    html += '</form>';
                }
                html += '</div>';
                html += '</div>';
            }

            let labels=[];
            for (let p = 0; p < props.length; p++) {
              labels.push(replacetext(".","",rmspace(props[p].label)));                 
            }
            for (let i = 0; i < data.length; i++) {
            
                
                html += '<div class="accordion-header headerlistedit'+data[i].id+' d-grid px-2 py-3" style="border-bottom:1px solid '+colortema.secondary+'" id="panelsStayOpen-heading'+data[i].id+'">';
                html += '<button style="border:none; background-color:transparent;" href="#" class="collapsed btnlists" data-order="edit" data-id="'+data[i].id+'" aria-current="true" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse'+data[i].id+'" aria-expanded="false" aria-controls="panelsStayOpen-collapse">';
                html += '<div class="d-flex justify-content-between" style="font-size:'+res.data.set.font_size+'">';
                for (let c = 0; c < res.data.utils.colshow.length; c++) {
                    html += '<div style="font-size:'+res.data.set.font_size+'">'+(data[i][res.data.utils.colshow[c]]==null?'-':data[i][res.data.utils.colshow[c]])+'</div>';  
                }
                
                html += '</div>';
                html += '</button>';
                html += '</div>';
                html += '<div id="panelsStayOpen-collapse'+data[i].id+'" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading'+data[i].id+'">';
                html += '<div class="accordion-body" style="background-color:'+colortema.light+'; border-bottom:1px solid '+colortema.mid_light+'">';
                html += '<div class="row">';
                let inputs=[];
                for (let cl = 0; cl < props.length; cl++) {           
                  if(props[cl].type=='radio' || props[cl].type=='checkbox'){
                    inputs.push(check(data[i].id,data[i][props[cl].col],res.data.utils, res.data.set, props[cl],res.data.datajs));
                  }
                  if(props[cl].type=='input'){
                    inputs.push(input(data[i].id,data[i][props[cl].col],res.data.utils, res.data.set, props[cl],res.data.datajs));
                  }
                  if(props[cl].type=='textarea'){
                    inputs.push(textarea(data[i].id,data[i][props[cl].col],res.data.utils, res.data.set, props[cl],res.data.datajs));
                  }
                  if(props[cl].type=='select'){
                        let col=props[cl].col;
                        exp=col.split("_");
                        if (exp[exp.length - 1] === 'id') {
                            // console.log(exp[0]);
                            col=(exp[0]=='user' || exp[0]=='anggotakelas'?'nama':exp[0]);
                        }
                         let text=data[i][col];
        
                    inputs.push(select(data[i].id,data[i][props[cl].col],res.data.utils, res.data.set, props[cl],text,res.data.datajs));
                  }
                }
                for (let x = 0; x < inputs.length; x++) {
                   html+=inputs[x]; 
                } 
                html += '</div>';//row
    
                html += '<div class="d-grid d-flex gap-2 justify-content-end mt-2">';

                html += '<button type="button" data-bs-toggle="modal" data-bs-target="#konfirmasi'+data[i].id+'" class="btn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+colors.danger.secondary+'; color:'+colors.danger.main+'">';
                html += '<i class="fa fa-trash"></i> Delete';
                html += '</button>';
                for (let c = 0; c < res.data.utils.copy.length; c++) {
                        html += '<button data-id="'+data[i].id+'" data-tabel="'+res.data.utils.tabel+'" data-menu="'+res.data.utils.menu+'" data-order="copy" type="submit" class="btn copy" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+colors.success.secondary+'; color:'+colors.success.dark+'">';
                        html += '<i class="fa fa-clone"></i> Copy';
                        html += '</button>';     
                }

                for (let p = 0; p < res.data.utils.print.length; p++) {
                    if(res.data.utils.print[p].format=='pdf'){

                        html += '<form action="'+baseUrl+'/prints/'+res.data.utils.print[p].controller+'" method="post" target="_blank">';
                        html += '<input type="hidden" name="controller" value="'+res.data.utils.print[p].controller+'">';
                        html += '<input type="hidden" name="tabel" value="'+res.data.utils.print[p].tabel+'">';
                        html += '<input type="hidden" name="menu" value="'+res.data.utils.menu+'">';
                        html += '<input type="hidden" name="id[]" value="'+data[i].id+'">';
                    html += '<div class="print d-grid gap-2 px-2 d-flex justify-content-center" style="font-size:'+res.data.set.font_size+'">';
                    if(res.data.utils.print[p].format=='pdf' && res.data.utils.menu=='Sk'){
                        html+='<div class="form-check form-switch pt-2" style="font-size:'+res.data.set.font_size+'">';
                        html+='<input class="form-check-input" name="isttd" type="checkbox" role="switch" id="flexSwitchCheckChecked">';
                        html+='<label class="form-check-label" style="color:'+colortema.dark+';" for="flexSwitchCheckChecked">Ttd</label>';
                        html+='</div>';
                    }
                    html += '<button type="submit" class="btn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+colors.success.secondary+'; color:'+colors.success.dark+'">';
                    html += '<i class="'+res.data.utils.print[p].icon+'"></i> '+res.data.utils.print[p].menu+' '+res.data.utils.print[p].format+'';
                    html += '</button>';
                    html += '</div>';
                    html += '</form>';
                    }
                }
                html += '<button type="button" data-order="edit" data-tabel="'+res.data.utils.tabel+'" data-idmenu="'+res.data.utils.idmenu+'" data-id="'+data[i].id+'" data-labels="'+labels.join(",")+'" data-id="'+data[i].id+'" class="btn save" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+colortema.secondary+'; color:'+colortema.dark+'">';
                html += '<i class="fa fa-folder-o"></i> Save';
                html += '</button>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                // modal

               html+='<div class="modal fade" id="konfirmasi'+data[i].id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitLabel" aria-hidden="true">';
                html+='<div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">';
                html+='<div class="modal-content">';
                html+='<div class="modal-header px-3 py-1 d-flex" style="font-size:'+res.data.set.font_size+'; border-color:'+colors.danger.mid_light+'; background-color:'+colors.danger.secondary+'">';

                html+='<div class="p-1"> <i class="fa fa-square" style="font-size:small; color:'+colors.danger.mid_dark+'"></i></div>';
                html+='<div class="p-1">';
                html+='<p class="modal-title" style="font-size:'+res.data.set.font_size+';color:'+colors.danger.main+'" id="submitLabel">Hapus Data</p>';
                html+='</div>';
                html+='<div class="ms-auto p-1"><button type="button" style="font-size:smaller" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';
                html+='</div>';
                html+='<div class="modal-body pb-0">';
                html+='<p style="font-size:'+res.data.set.font_size+';color:'+colors.danger.main+'">Yakin hapus data ini?</p>';
                html+='</div>';
                html+='<div class="d-grid gap-1 d-flex justify-content-center py-2" style="border-top:1px solid '+colors.danger.mid_light+'; background-color:'+colortema.light+'">';
                html+='<button data-idmenu="'+res.data.utils.idmenu+'" data-id="'+data[i].id+'" data-tabel="'+res.data.utils.tabel+'" type="button" class="btn delete" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+colors.danger.secondary+'; color:'+colors.danger.main+'">';
                html+='<i class="fa fa-trash"></i> Yes';
                html+='</button>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
            }


        }

    }
    $('.body').html(html);
})

}

    const check=(id,val,utils,set, props, datajs)=>{
        // console.log(datajs)
        // console.log(val);
        let html="";
        if(props.format=="main"){
            let exp=props.query.split(',');
            let ops=[];
            for(let i in exp){
                let val=exp[i];
                let exp2=val.split("=");
                ops.push({'text':exp2[0], 'val':exp2[1]});

            }
            html += '<div class="col-md-6" style="'+(props.display?"display:none":"")+'">';
            html+='<div class="input-group input-group-sm mb-1" style="font-size:'+set.font_size+'">';
            html+='<span class="input-group-text" style="width:100px;font-size:'+set.font_size+';background-color:'+set.colortema.secondary+';border-color:'+set.colortema.mid_light+'">'+props.label+'</span>';
            for (let i = 0; i < ops.length; i++) {
                html+='<div class="form-check form-switch pt-2" style="font-size:'+set.font_size+'">';
                html+='<input ';
                for (let d = 0; d < datajs.length; d++) {
                   if(props[datajs[d]] !==''){
                    html+=' data-'+datajs[d]+"="+(datajs[d]=='label'?replacetext(".", "",replacetext(" ", "",props[datajs[d]])):props[datajs[d]]);
                   }
                    
                }
                html+=' class="form-check-input edit'+replacetext(".", "",rmspace(props.label))+id+'" value="'+ops[i].val+'" name="edit'+replacetext(".", "",rmspace(props.label))+id+'" style="font-size:'+set.font_size+'" type="'+props.type+'" role="switch" id="'+props.col+ops[i].val+'" '+(props.required?'required':'')+' '+(props.disabled?'disabled':'')+' '+(val === ops[i].val?'checked':'')+'>';
                html+='<label class="form-check-label" style="font-size:'+set.font_size+'" for="'+props.col+ops[i].val+'">'+ops[i].text+'</label>';
                html+='</div>';
            }
            html+='</div>';
            html += '</div>';//col
        }
        return html;
    }
    const input=(id,val,utils,set, props, datajs)=>{
        let html="";
        if(props.format=="main" || props.format=="click"){
            html += '<div class="col-md-6" style="'+(props.display?"display:none":"")+'">';
            html += '<div class="input-group input-group-sm mb-1" style="font-size:'+set.font_size+';">';
            html += '<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:'+set.font_size+';background-color:'+set.colortema.secondary+';border-color:'+set.colortema.mid_light+'">'+props.label+'</span>';
            html += '<input ';
            for (let d = 0; d < datajs.length; d++) {
                if(props[datajs[d]] !==''){
                 html+=' data-'+datajs[d]+"="+(datajs[d]=='label'?replacetext(".", "",replacetext(" ", "",props[datajs[d]])):props[datajs[d]]);
                }
                 
             }
            html+=' data-order="edit" data-id="'+id+'" style="font-size:'+set.font_size+'; border-color:'+set.colortema.mid_light+'" name="'+props.col+'" type="text" value="'+val+'" class="form-control '+(props.format=="click"?'click':'')+' edit'+replacetext(".", "",rmspace(props.label))+id+'" placeholder="'+props.label+'" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" '+(props.required?'required':'')+' '+(props.disabled?'disabled':'')+'>';
            html += '</div>';
            html += '</div>';//col
        }
        return html;
    }
    const textarea=(id,val,utils,set, props, datajs)=>{
        let html="";
        if(props.format=="main"){
            html += '<div class="col-md-6" style="'+(props.display?"display:none":"")+'">';
            html += '<div class="input-group input-group-sm mb-1" style="font-size:'+set.font_size+';">';
            html += '<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:'+set.font_size+';background-color:'+set.colortema.secondary+';border-color:'+set.colortema.mid_light+'">'+props.label+'</span>';
            html += '<textarea ';
            for (let d = 0; d < datajs.length; d++) {
                if(props[datajs[d]] !==''){
                 html+=' data-'+datajs[d]+"="+(datajs[d]=='label'?replacetext(".", "",replacetext(" ", "",props[datajs[d]])):props[datajs[d]]);
                }
                 
             }
            html +=' style="font-size:'+set.font_size+'; border-color:'+set.colortema.mid_light+'" name="'+props.col+'" type="text" class="form-control edit'+replacetext(".", "",rmspace(props.label))+id+'" placeholder="'+props.label+'" aria-label="Sizing example input" aria-label=" With textarea" '+(props.required?'required':'')+' '+(props.disabled?'disabled':'')+'>'+val+'</textarea>';
            html += '</div>';
            html += '</div>';//col
        }
        return html;
    }
    const select=(id,val,utils,set, props, text, datajs)=>{
        let html="";
            html += '<div class="col-md-6" style="'+(props.display?"display:none":"")+'" '+text+'>';
            html += '<div class="input-group input-group-sm mb-1" style="font-size:'+set.font_size+';">';
            html += '<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:'+set.font_size+';background-color:'+set.colortema.secondary+';border-color:'+set.colortema.mid_light+'">'+props.label+'</span>';
            html += '<input ';
            for (let d = 0; d < datajs.length; d++) {
                if(datajs[d] !=='col'){
                if(props[datajs[d]] !==''){
                 html+=' data-'+datajs[d]+"="+(datajs[d]=='label'?replacetext(".", "",replacetext(" ", "",props[datajs[d]])):props[datajs[d]]);
                }
                }
                 
             }
            html+=' data-order="edit" '+(props.format=="multi"?"data-multi="+props.multi+"":"")+' data-id="'+id+'" data-menu="'+utils.menu+'" style="font-size:'+set.font_size+'; border-color:'+set.colortema.mid_light+'" name="'+props.col+'" type="text" data-val="'+val+'" value="'+(val==0?'-':text)+'" data-oldval="'+(val==0?'-':text)+'" class="form-control select edit'+replacetext(".", "",rmspace(props.label))+id+'" placeholder="'+props.label+'" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" '+(props.required?'required':'')+' '+(props.disabled?'disabled':'')+'>';
            html+= '<div class="list-group bodyselectedit'+replacetext(" ", "",props.label)+id+'" style="font-size:'+set.font_size+';position:absolute;z-index:10;left:95px;top:34px;width:230px; display:none;">';
            html+='</div>';
            html += '</div>';
            html += '</div>';
        return html;
    }

    const dokumen=(req)=>{
      let data=req.data;
      let utils=req.utils;
      let set=req.set;
      let props=req.props;


        let html="";
        if(data.length==0){
            html+='<div class="mt-3 text-center" style="font-weight:bold;color:'+set.colors.danger.mid_dark+';font-size:'+set.font_size+';padding:5px 10px 5px 10px; border:1px solid '+set.colors.danger.mid_dark+'; border-radius:10px; background-color:'+set.colors.danger.secondary+'"><i class="fa fa-minus-circle"></i>Data tidak ditemukan!.</div>';
        }else{
            for (let i = 0; i < data.length; i++) {
                // console.log(data[i]);
                html+='<div class="mt-3 text-center" style="font-weight:bold;color:'+set.colortema.mid_dark+';font-size:'+set.font_size+';padding:5px 10px 5px 10px; border:1px solid '+set.colortema.mid_dark+'; border-radius:10px; background-color:'+set.colortema.secondary+'">'+data[i].nama+'</div>';
               for (let p = 0; p < utils.colshow.length; p++) {
                   html+='<div class="col-md-6" style="'+(data[i].display?'display:none':'')+'">';
                   html+='<div class="card p-1">';
                   let exp=data[i][utils.colshow[p]].toLowerCase().split(".");
                       if(exp[exp.length - 1] == 'jpg' || exp[exp.length - 1] == 'jpeg' || exp[exp.length - 1] == 'png'){
                           html+='<div class="m-auto click dokumen'+replacetext(".", "",replacetext(' ', '',data[i].label))+data[i].id+'" data-query="zoom" style="cursor: pointer;width:100px; height:100px;background-position: center; background-size: contain;background-repeat: no-repeat; background-image:url(images/'+data[i][utils.colshow[p]]+')">';
                           html+='</div>';
                       }else{
                        html+='<a class="text-center" href="images/'+data[i][utils.colshow[p]]+'">Berkas '+data[i][utils.colshow[p]].slice(0,10)+'</a>';
                       }
                   html+='<div class="card-body">';
                   html+='<form action="'+baseUrl+'/dashboard/dokumen" method="post" enctype="multipart/form-data">';
                   html+='<input type="hidden" name="id" value="'+data[i].id+'">';
                   html+='<input type="hidden" name="tabel" value="'+utils.table+'">';
                   html+='<input type="hidden" name="menu" value="'+utils.menu+'">';
                   html+='<input type="hidden" name="col" value="'+data[i].col+'">';
                   html+='<input type="hidden" name="ext" value="'+data[i].query+'">';
                   html+='<div class="d-grid gap-2 d-flex justify-content-center">';
                   html+='<label class="uploadLabel" style="background-color:'+set.colors.primary.secondary+'; color:'+set.colors.primary.dark+'; font-size:'+set.font_size+';">';
                   html+='<input data-order="dokumen" data-id="'+data[i].id+'" data-label="'+replacetext(".", "",replacetext(' ', '',data[i].label))+'" type="file" name="dokumen" class="uploadButton inputdokumen" />';
                   html+='Pilih '+utils.colshow[p]+'';
                   html+='</label>';
                   
                   html+='<button style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;background-color:'+set.colortema.secondary+'; color:'+set.colortema.dark+';" type="submit" class="btn btn-sm"><i class="fa fa-upload"></i> Upload</button>';
                   html+='</div>';
                   html+='</form>';
                   html+='</div>';
                   html+='</div>';
                   html+='</div>';
                }
                html+='</div>';
            }
        }

        $('.bodydokumen').html(html);
           
     }


     const copy=(req)=>{
        let data=req.data;
        let props=req.props;
        let utils=req.utils;
        let datajs=req.datajs;
        let set=req.set;
        let labels=req.labels;
        let html="";
        html+='<div class="offcanvas offcanvas-start" tabindex="-1" id="copy" aria-labelledby="offcanvasExampleLabel">';
        html+='<div class="offcanvas-header px-3 py-2 d-flex" style="color:'+set.colortema.dark+'; background-color:'+set.colortema.mid_light+'">';

            html+='<div class="p-1"> <i class="fa fa-square" style="font-size:small;"></i></div>';
            html+='<div class="p-1">';
            html+='<p class="modal-title" style="color:'+set.colortema.dark+'" id="submitLabel">Copy '+utils.menu+'</p>';
            html+='</div>';
            html+='<div class="ms-auto p-1"><button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button></div>';
            html+='</div>';

        html+='<div class="offcanvas-body" style="font-size:'+set.font_size+'; color:'+set.colortema.dark+'; background-color:'+set.colortema.light+'">';
 
        for (let i = 0; i < props.length; i++) {
            html+='<div class="input-group input-group-sm mb-1" style="border-color:'+set.colortema.main+'; '+(props[i].display?"display:none":"")+'">';
            html+='<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:'+set.font_size+'; background-color:'+set.colortema.secondary+';border-color:'+set.colortema.mid_light+'">'+props[i].label+'</span>';
           if(props[i].type=='textarea'){
               html+='<textarea ';
               for (let d = 0; d < datajs.length; d++) {
                   if(datajs[d] !=='type'){
                   if(props[i][datajs[d]] !==''){
                    html+=' data-'+datajs[d]+"="+(datajs[d]=='label'?replacetext(".", "",replacetext(" ", "",props[i][datajs[d]])):props[i][datajs[d]]);
                   }
                   }
                    
                }
               html+=' data-order="copy" data-type="textarea" style="font-size:'+set.font_size+'; border-color:'+set.colortema.mid_light+';" name="'+props[i].col+'" type="text" class="form-control copy'+replacetext(".", "",replacetext(" ", "",props[i].label))+'" placeholder="'+props[i].label+'" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" '+(props[i].required?'required':'')+' '+(props[i].disabled?'disabled':'')+'>'+data[props[i].col]+'</textarea>';
            }else{
               html+='<input ';
               for (let d = 0; d < datajs.length; d++) {
                   if(datajs[d] !=='type'){
                   if(props[i][datajs[d]] !==''){
                    html+=' data-'+datajs[d]+"="+(datajs[d]=='label'?replacetext(".", "",replacetext(" ", "",props[i][datajs[d]])):props[i][datajs[d]]);
                   }
                   }
                    
                }
               html+=' data-order="copy" data-type="input" style="font-size:'+set.font_size+'; border-color:'+set.colortema.mid_light+';" name="'+props[i].col+'" type="text" value="'+data[props[i].col]+'" class="form-control copy'+replacetext(".", "",replacetext(" ", "",props[i].label))+'" placeholder="'+props[i].label+'" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" '+(props[i].required?'required':'')+' '+(props[i].disabled?'disabled':'')+'>';
           }
            html+='</div>';
            
        }
        html+='<div class="d-grid gap-2">';
        html+='<button data-order="copy" data-labels="'+labels+'" data-tabel="'+utils.tabel+'" data-idmenu="'+utils.idmenu+'" data-id="'+data.id+'" type="button" class="btn save" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+set.colortema.secondary+'; color:'+set.colortema.dark+'">';
        html+='<i class="fa fa-folder-o"></i> Save';
        html+='</button>';
        html+='</div>';
        html+='</div>';

    html+='</div>';
    html+='</div>';
        $('.bodycopy').html(html);
     }


     const insertpreview=(props,set,data,query)=>{
        let html='';
        html+='<div class="prevcetak headerprevcetak'+$(this).data('id')+'" data-lists="'+$(this).data('nama')+' '+$(this).data('username')+'">';
        html+='<div class="accordion-header headerlist'+query+$(this).data("id")+' d-grid px-2 py-3" style="border-bottom:1px solid '+set.colortema.secondary+'" id="panelsStayOpen-heading">';
        html+='<button style="border:none; background-color:transparent;" href="#" data-id="'+$(this).data('id')+'" data-order="'+query+'" class="collapsed btnlists" aria-current="true" data-bs-toggle="collapse" data-bs-target="#bodyprevcetak'+$(this).data('id')+'" aria-expanded="false" aria-controls="bodyprevcetak'+$(this).data('id')+'">';
        html+='<div class="d-flex" style="font-size:'+set.font_size+';">';
        html+='<div style="width:13%; font-size:'+set.font_size+'" class="text-start">00</div>';

        html+='<div style="width:37%;font-size:'+set.font_size+'" class="text-start">'+data.username+'</div>';
        html+='<div style="width:37%;font-size:'+set.font_size+'" class="text-start">'+data.nama+'</div>';

        html+='<div data-id="'+$(this).data('id')+'" data-query="prevcetak" class="hapus"><i class="fa fa-trash"></i></div>';
        // <?php endif; ?>
        html+='</div>';
        html+='</button>';
        html+='</div>';

        html+='</div>';

        // body

        html+='<div id="bodyprevcetak'+$(this).data('id')+'" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading">';
                    html+='<div class="accordion-body p-2" style="background-color:'+set.colortema.secondary+'; border-bottom:1px solid '+set.colortema.mid_light+'">';
                        html+='<div class="row">';
                       
                                for (let p = 0; p < props.length; p++) {
                                 
                                html+='<div class="col-md-6" style="font-size:'+set.font_size+'; '+(props[p].display?'display:none':'')+'">';
                                html+='<div class="input-group input-group-sm mb-1 style=" border-color:'+set.colortema.main+';font-size:'+set.font_size+'">';
                                html+='<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:'+set.font_size+'; background-color:'+set.colortema.light+';border-color:'+set.colortema.mid_light+'">'+props[p].label+'</span>';
                                html+='<input style="font-size:'+set.font_size+'; border-color:'+set.colortema.mid_light+'; background-color:'+set.colortema.light+';" type=" text" value="'+data[props[p].col]+'" class="form-control '+query+props[p].col+'" placeholder="'+props[p].label+'" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">';
                                html+='</div>';
                                html+='</div>';
                            }
                            // <?php endforeach; ?>
                        html+='</div>';

                    html+='</div>';
                html+='</div>';
        $(".listpreview").prepend(html);
        sukses(false);
        $('.selectpreview').val('');
        $('.bodyselectpreview').hide();
     }

     const preview=(data=null)=>{
        if(data==null){
            post('dashboard/preview', {
                'menu':mainMenu
                })
                .then(res => {
                   if(res.status=='200'){
                    if(res.data.length>0){
                        for (let i = 0; i < res.data.length; i++) {
                            // console.log(res.data[i].utils.typeof)
                                 previewfunc[res.data[i].utils.typeof](res.data[i]);   
                        }
                    }
                   }
               })

        }else{
            for (let i = 0; i < data.length; i++) {
                     previewfunc[data[i].utils.typeof](data[i]);   
            }
        }
     }

     const previewfunc = {
        list: function(datas) {
            let data=datas.data;
            let html='';

            html+='<div class="accordion-item" style="border-bottom:1px solid '+datas.set.colortema.secondary+'; background-color:'+datas.set.colortema.main+';border-radius:0px 0px 0px 0px">';
            html+='<div class="accordion-header d-grid px-2 py-3" style="border-bottom:1px solid '+datas.set.colortema.secondary+';" id="panelsStayOpen-headingheader">';
            html+='<button style="border:none; background-color:transparent;" href="#" class="collapsed" aria-current="true" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseheader" aria-expanded="false" aria-controls="panelsStayOpen-collapseheader">';
            html+='<div class="d-flex" style="font-size:'+datas.set.font_size+'; color:'+datas.set.colortema.light+'">';
            html+='<div style="width:13%;font-size:'+datas.set.font_size+'" class="text-start">No.</div>';
                for (let i = 0; i < datas.utils.colshow.length; i++) {
                    for (let p = 0; p < datas.props.length; p++) {
                        if(datas.utils.colshow[i]== datas.props[p].col){
                        html+='<div style="width:'+(i==0?"50%":"37%")+';font-size:'+datas.set.font_size+'" class="text-start">'+datas.props[p].label+'</div>';
                        }
                    } 
                }
            html+='</div>';
            html+='</button>';
            html+='</div>';
            html+='</div>';
            for (let pr = 0; pr < datas.utils.printself.length; pr++) {
                let preview='prev'+datas.utils.printself[pr].preview;
                if(preview==datas.query){
                html+='<div class="print d-grid gap-2 d-flex justify-content-center">';
                let prints=datas.utils.printself[pr].data;
                    for (let pd = 0; pd < prints.length; pd++) {
                        html += '<form>';
                        html += '<input type="hidden" name="controller" value="'+prints[pd].controller+'">';
                        let cols=[];
                            for (let pr = 0; pr < datas.props.length; pr++) {
                                if(datas.props[pr].col !=='gelar'){
                                  cols.push(datas.props[pr].col);
                                }
                            }
                // console.log(datas.props);
                        if(prints[pd].format=='pdf'){
                        html += '<div class="print d-grid gap-2 px-2 d-flex justify-content-center" style="font-size:'+datas.set.font_size+'">';
                            html+='<select name="orientasi" style="width:35%; font-size:'+datas.set.font_size+'" class="form-select form-select-sm orientasi'+preview+'" aria-label=".form-select-sm example">';
                            html+='<option value="P" selected>Potrait</option>';
                            html+='<option value="L">Lanscape</option>';
                            html+='</select>';
                            html += '<input name="cols" style="width:18%; font-size:'+datas.set.font_size+'" type="text" class="form-control form-control-sm cols'+preview+'" placeholder="Cols">';
                            html += '<input name="judul" type="text" style="font-size:'+datas.set.font_size+'" class="form-control form-control-sm judul'+preview+'" placeholder="Judul">';
                            html += '</div>';
                            html+='<div class="print d-grid gap-2 d-flex justify-content-center">';
                        }
                        html += '<button type="button" data-query="'+preview+'" data-menu="'+datas.utils.menu+'" data-cols="'+cols+'" data-controller="'+baseUrl+'/prints/'+prints[pd].controller+'" class="btn printself" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+datas.set.colortema.mid_light+'; color:'+datas.set.colortema.dark+'">';
                        html += '<i class="'+prints[pd].icon+'"></i> Cetak '+prints[pd].format+'';
                        html += '</button>';
                        html += '</form>';
                    }
                    html += '</div>';
                html += '</div>';
                }
            }
            html+='<div class="listpreview">';
            for (let i = 0; i < data.length; i++) {
            
                    html+='<div class="'+datas.query+' header'+datas.query+''+data[i].id+'" data-lists="';
                    for (let c = 0; c < datas.utils.colshow.length; c++) {
                    html+=data[i][datas.utils.colshow[c]]+' ';                
                    }
                    html+='">';
                    html+='<div class="accordion-header d-grid px-2 py-3 headerlist'+datas.query+data[i].id+'" style="border-bottom:1px solid '+datas.set.colortema.secondary+'" id="panelsStayOpen-heading">';
                    html+='<button style="border:none; background-color:transparent;" href="#" data-id="'+data[i].id+'" class="collapsed btnlists" data-order="'+datas.query+'" data-id="'+data[i].id+'" aria-current="true" data-bs-toggle="collapse" data-bs-target="#body'+datas.query+''+data[i].id+'" aria-expanded="false" aria-controls="body'+datas.query+''+data[i].id+'">';
                    html+='<div class="d-flex" style="font-size:'+datas.set.font_size+';">';
                    html+='<div style="width:13%; font-size:'+datas.set.font_size+'" class="text-start">'+(i+1)+'</div>';
                    for (let co = 0; co < datas.utils.colshow.length; co++) {
                    html+='<div style="width:'+(co==0?"50%":"37%")+';font-size:'+datas.set.font_size+'" class="text-start">'+data[i][datas.utils.colshow[co]]+'</div>';

                    }
                    if(datas.utils.edited=='enable'){
                    html+='<div data-id="'+data[i].id+'" data-query="'+datas.query+'" class="hapus"><i class="fa fa-trash"></i></div>';
                    }
                    html+='</div>';
                    html+='</button>';
                    html+='</div>';

                    html+='</div>';

                    html+='<div id="body'+datas.query+''+data[i].id+'" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading">';
                    html+='<div class="accordion-body p-2" style="background-color:'+datas.set.colortema.secondary+'; border-bottom:1px solid '+datas.set.colortema.mid_dark+'">';
                    html+='<div class="row">';
                    for (let p = 0; p < datas.props.length; p++) {
                    html+='<div class="col-md-6" style="font-size:'+datas.set.font_size+'; '+(datas.props[p].display?'display:none':'')+'">';
                    html+='<div class="input-group input-group-sm mb-1 style=" border-color:'+datas.set.colortema.main+';font-size:'+datas.set.font_size+'">';
                    html+='<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:'+datas.set.font_size+'; background-color:'+datas.set.colortema.light+';border-color:'+datas.set.colortema.mid_light+'">'+datas.props[p].label+'</span>';
                    html+='<input style="font-size:'+datas.set.font_size+'; border-color:'+datas.set.colortema.mid_light+'; background-color:'+datas.set.colortema.light+';" type=" text" value="'+data[i][datas.props[p].col]+'" class="form-control '+datas.query+datas.props[p].col+'" placeholder="'+datas.props[p].label+'" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" '+(datas.utils.edited=='disable'?'disabled':'')+'>';
                    html+='</div>';
                    html+='</div>';

                    }
                    html+='</div>';

                    html+='</div>';
                    html+='</div>';
            }
                html+='</div>';
            
            html+='<div class="d-grid d-flex gap-2 justify-content-end mt-1">';
            html+='<button type="button" class="loadmore btn" data-order="plus" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+datas.set.colortema.secondary+'; color:'+datas.set.colortema.dark+'" data-query="'+datas.query+'" data-menu="'+datas.utils.menu+'" href="#"><i class="fa fa-plus-circle"></i></button>';
            html+='<button type="button" class="loadmore btn" data-order="minus" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+datas.set.colortema.secondary+'; color:'+datas.set.colortema.dark+'" data-query="'+datas.query+'" data-menu="'+datas.utils.menu+'" href="#"><i class="fa fa-minus-circle"></i></button>';
            html+='</div>';
           $('.bodypreview'+datas.query).html(html);
        },
        slide: function(data) {
         
          },
        cabang: function(req) {
            // console.log(req);
            let html='';
            let data=req.data;
            let props=req.props;
            html+='<div class="accordion-item" style="border-bottom:1px solid '+req.set.colortema.secondary+'; background-color:'+req.set.colortema.main+';border-radius:0px 0px 0px 0px">';
            html+='<div class="accordion-header d-grid px-2 py-3" style="border-bottom:1px solid '+req.set.colortema.secondary+';" id="panelsStayOpen-headingheader">';
            html+='<button style="border:none; background-color:transparent;" href="#" class="collapsed" aria-current="true" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseheader" aria-expanded="false" aria-controls="panelsStayOpen-collapseheader">';
            html+='<div class="d-flex" style="font-size:'+req.set.font_size+'; color:'+req.set.colortema.light+'">';
            html+='<div style="width:13%;font-size:'+req.set.font_size+'" class="text-start">No.</div>';
                for (let i = 0; i < req.utils.colshow.length; i++) {
                    for (let p = 0; p < req.props.length; p++) {
                        if(req.utils.colshow[i]== req.props[p].col){
                        html+='<div style="width:'+(i==0?"50%":"37%")+';font-size:'+req.set.font_size+'" class="text-start">'+req.props[p].label+'</div>';
                        }
                    } 
                }
            html+='</div>';
            html+='</button>';
            html+='</div>';
            html+='</div>';

          


            
            let kelas=[];
            let kel=[];
            for (let k = 0; k < data.length; k++) {
                if (jQuery.inArray(data[k].tahun+data[k].kelas, kel) !== -1) {
                   continue;
                } else{
                    kelas.push({'id':replacetext(" ", "",data[k].tahun+data[k].kelas),'tahun':data[k].tahun,'kelas':data[k].kelas});
                    kel.push(data[k].tahun+data[k].kelas);
                }         
            }


          for (let kl = 0; kl < kelas.length; kl++) {
            html+='<div class="'+req.query+' header'+req.query+''+kelas[kl].id+'" data-lists="';
            for (let c = 0; c < req.utils.colshow.length; c++) {
            html+=kelas[kl][req.utils.colshow[c]]+' ';                
            }
            html+='">';
            html+='<div class="accordion-header d-grid px-2 py-3 headerlist'+req.query+kelas[kl].id+'" style="border-bottom:1px solid '+req.set.colortema.secondary+'" id="panelsStayOpen-heading">';
            html+='<button style="border:none; background-color:transparent;" href="#" data-id="'+kelas[kl].id+'" class="collapsed btnlists" data-order="'+req.query+'" data-id="'+kelas[kl].id+'" aria-current="true" data-bs-toggle="collapse" data-bs-target="#body'+req.query+''+kelas[kl].id+'" aria-expanded="false" aria-controls="body'+req.query+''+kelas[kl].id+'">';
            html+='<div class="d-flex" style="font-size:'+req.set.font_size+';">';
            html+='<div style="width:13%; font-size:'+req.set.font_size+'" class="text-start">'+(kl+1)+'</div>';
            for (let co = 0; co < req.utils.colshow.length; co++) {
            html+='<div style="width:'+(co==0?"50%":"37%")+';font-size:'+req.set.font_size+'" class="text-start">'+kelas[kl][req.utils.colshow[co]]+'</div>';

            }
            html+='</div>';
            html+='</button>';
            html+='</div>';

            html+='</div>';


    


            html+='<div id="body'+req.query+''+kelas[kl].id+'" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading">';
            html+='<div class="accordion-body p-2" style="background-color:'+req.set.colortema.secondary+'; border-bottom:1px solid '+req.set.colortema.mid_dark+'">';
            if(req.print.length>0){
                html+='<div class="print mb-2 d-grid gap-2 d-flex justify-content-center">';
                
                for (let p = 0; p < req.print.length; p++) {
                    html += '<form action="'+baseUrl+'/prints/'+req.print[p].controller+'" method="post" target="_blank">';
                    html += '<input type="hidden" name="controller" value="'+req.print[p].controller+'">';
                    html += '<input type="hidden" name="tabel" value="'+req.print[p].tabel+'">';
                    html += '<input type="hidden" name="menu" value="'+req.utils.menu+'">';
                    html += '<input type="hidden" name="query" value="'+req.query+'">';
                    for (let d = 0; d < data.length; d++) {
                        let dataid=replacetext(" ", "", data[d].tahun+data[d].kelas);
                        if(dataid==kelas[kl].id){
                        html += '<input type="hidden" name="id[]" value="'+data[d].id+'">';
                    }
                    }
        
                    if(req.print[p].format=='pdf'){
                    html += '<div class="print d-grid gap-2 px-2 d-flex justify-content-center" style="font-size:'+req.set.font_size+'">';
                        html+='<div class="form-check form-switch pt-1" style="font-size:'+req.set.font_size+'">';
                        html+='<input class="form-check-input" name="list" type="checkbox" role="switch" id="flexSwitchCheckChecked">';
                        html+='<label class="form-check-label" style="color:'+req.set.colortema.dark+';" for="flexSwitchCheckChecked">List</label>';
                        html+='</div>';
                        html+='<select name="orientasi" style="width:35%; font-size:'+req.set.font_size+'" class="form-select form-select-sm" aria-label=".form-select-sm example">';
                        html+='<option value="P" selected>Potrait</option>';
                        html+='<option value="L">Lanscape</option>';
                        html+='</select>';
                        html += '<input name="cols" style="width:18%; font-size:'+req.set.font_size+'" type="text" class="form-control form-control-sm" placeholder="Cols">';
                        html += '<input name="judul" type="text" style="font-size:'+req.set.font_size+'" class="form-control form-control-sm" placeholder="Judul">';
                        html += '</div>';
                        html+='<div class="print d-grid gap-2 d-flex justify-content-center">';
                    }
                    html += '<button type="submit" class="btn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+req.set.colortema.mid_light+'; color:'+req.set.colortema.dark+'">';
                    html += '<i class="'+req.print[p].icon+'"></i> '+firstwordupcase(req.print[p].menu.substring(4))+' '+req.print[p].format+'';
                    html += '</button>';
                    html += '</form>';
                }
                html += '</div>';
                html += '</div>';
            }
            html+='<div class="row">';
            let labels=[];
            let no=0;
            for (let i = 0; i < data.length; i++) {
                let dataid=replacetext(" ", "", data[i].tahun+data[i].kelas);
                if(dataid==kelas[kl].id){
                    no++;
                    html+='<div class="col-md-6">';
                    for (let cl = 0; cl < props.length; cl++) {
                        if(props[cl].col=='user_id'){
                            html+='<div class="input-group input-group-sm my-1" style="font-size:'+req.set.font_size+';">';
                            html+='<span class="input-group-text" id="inputGroup-sizing-sm" style="width:40px;font-size:'+req.set.font_size+';background-color:'+req.set.colortema.mid_dark+';border-color:'+req.set.colortema.mid_light+';">'+no+'</span>';
                            html+='<input style="font-size:'+req.set.font_size+'; border-color:'+req.set.colortema.mid_light+'; background-color:'+req.set.colortema.light+';" type=" text" value="'+data[i].nama+'" class="form-control caripreview" placeholder="..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" disabled>';
                            html+='</div>';
                        }
                            
                    }
                    
                    html+='<div class="cabang'+req.query+dataid+data[i].id+' mt-2" style="display:none;">';
                    html += '<div class="d-grid d-flex gap-2 justify-content-end">';
                    html += '<button type="button" data-order="edit" data-cabang="'+req.query+'" data-dataid="'+dataid+'" data-id="'+data[i].id+'" class="btn showeditcabang" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+req.set.colors.danger.secondary+'; color:'+req.set.colors.danger.dark+'">';
                    html += '<i class="fa fa-folder-o"></i> Cancel';
                    html += '</button>';
                    html += '<button type="button" data-order="edit" data-cabang="'+req.query+'" data-dataid="'+dataid+'" data-id="'+data[i].id+'" data-tabel="'+req.utils.table+'" data-idmenu="'+req.utils.idmenu+'" data-id="'+data[i].id+'" data-labels="'+labels.join(",")+'" class="btn save" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+req.set.colortema.secondary+'; color:'+req.set.colortema.dark+'">';
                    html += '<i class="fa fa-folder-o"></i> Save';
                    html += '</button>';
                    html+='</div>';
                    html+='</div>';

                    html+='</div>';
                }
                    
            }
        
            
            html+='</div>';
            html+='</div>';
            html+='</div>';
            
          }

           $('.bodypreview'+req.query).html(html);
          },
          nilai: function(req) {
            let html='';
            let data=req.data;
            let props=req.props;
            let labels=[];
            for (let p = 0; p < props.length; p++) {
                if(props[p].col !=='anggotakelas_id' && props[p].col !=='kelas'){
                    labels.push(replacetext(" ", "", replacetext(".", "",props[p].label)));
                }
            }
            html+='<div class="row">';
            if(data.length==0){
                html+='<div class="d-grid gap-1 d-flex justify-content-center p-2" style="border-top:1px solid '+req.set.colortema.mid_light+'; background-color:'+req.set.colortema.light+'">';
                html+='<a class="btn createabsen" data-tabel="tahfidz" data-menu="'+req.utils.menu+'" href="#" type="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+req.set.colortema.secondary+'; color:'+req.set.colortema.dark+'">';
                html+='<i class="fa fa-shield"></i> Buat Pantauan Hari Ini';
                html+='</a>';
                html+='</div>';
            }
            for (let i = 0; i < data.length; i++) {
                let clr=req.set.colortema.dark;
                if(data[i].akhlaq_pengurus>0 && data[i].akhlaq_guru>0 && data[i].kedisiplinan_ketertiban>0 && data[i].kedisiplinan_kerapian>0 && data[i].kedisiplinan_pelanggaran>0 && data[i].absen !=='' && data[i].keterangan !=='' && data[i].nilai>0 ){
                    clr=req.set.colortema.main;
                }
                html+='<div class="col-md-6 mb-1">';
                html+='<div class="card">';
                html+='<div class="card-body p-1">';
                html+='<a href="#" type="button" class="list-group-item list-group-item-action mb-1" aria-current="true" data-bs-toggle="modal" data-bs-target="#absentahfidz'+data[i].id+'">';
                html+='<div class="input-group input-group-sm" style="font-size:'+req.set.font_size+'">';
                html+='<span style="font-size:'+req.set.font_size+';background-color:'+req.set.colortema.mid_dark+'; width:8%;background-color:'+req.set.colortema.mid_dark+';border-color:'+req.set.colortema.secondary+'" class="input-group-text" id="basic-addon1">'+(i+1)+'</span>';
                html+='<span style="font-size:'+req.set.font_size+'; width:69%;background-color:'+req.set.colortema.secondary+';border-color:'+req.set.colortema.secondary+'" class="input-group-text" id="basic-addon1">'+data[i].nama+'</span>';
                html+='<span style="font-size:'+req.set.font_size+';width:15%;background-color:'+req.set.colortema.secondary+';border-color:'+req.set.colortema.secondary+'" class="input-group-text" id="basic-addon1">'+data[i].kelas+'</span>';
                html+='<span style="font-size:'+req.set.font_size+'; width:8%;background-color:'+req.set.colortema.secondary+';border-color:'+req.set.colortema.secondary+'" class="input-group-text" id="basic-addon1"><i class="fa fa-circle" style="color:'+clr+'"></i></span>';
                html+='</div>';
                html+='</a>';
                html+='</div>';
                html+='</div>';
                html+='</div>';

                // modal
                html+='<div class="modal fade" id="absentahfidz'+data[i].id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitLabel" aria-hidden="true">';
                html+='<div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">';
                html+='<div class="modal-content">';
                html+='<div class="modal-header px-3 py-2 d-flex" style="font-size:'+req.set.font_size+'; border-color:'+req.set.colortema.mid_light+'; background-color:'+req.set.colortema.secondary+'">';

                html+='<div class="p-1"> <i class="fa fa-square" style="font-size:small; color:'+req.set.colortema.mid_dark+'"></i></div>';
                html+='<div class="p-1">';
                html+='<p class="modal-title" id="submitLabel">'+data[i].nama+'</p>';
                html+='</div>';
                html+='<div class="ms-auto p-1"><button type="button" style="font-size:smaller" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';

                html+='</div>';
                html+='<div class="modal-body">';
               
                for (let p = 0; p < props.length; p++) {
                    if(props[p].col !=='anggotakelas_id' && props[p].col !=='kelas'){
                        html+='<div class="input-group input-group-sm mb-1" style="font-size:'+req.set.font_size+'">';
                        html+='<span style="font-size:'+req.set.font_size+'; width:150px;background-color:'+req.set.colortema.secondary+';border-color:'+req.set.colortema.mid_light+'" class="input-group-text" id="basic-addon1">'+props[p].label+'</span>';
                        html+='<input name="'+props[p].col+'" data-menu="'+req.utils.menu+'" data-type="'+props[p].type+'" ';
                        if(props[p].type=='select'){
                            html+='data-val="'+data[i][props[p].col]+'" data-oldval="'+data[i][props[p].col]+'"';
                        }
                        html+=' value="'+data[i][props[p].col]+'" data-format="'+props[p].format+'" data-case="'+props[p].case+'" data-query="'+props[p].query+'" data-order="edit" data-id="'+data[i].id+'" type="text" data-label="'+replacetext(" ", "", replacetext(".", "",props[p].label))+'" style="font-size:'+req.set.font_size+';" class="form-control '+(props[p].type=='select'?'select':'')+' edit'+replacetext(" ", "", replacetext(".", "",props[p].label))+data[i].id+'" placeholder="'+props[p].label+'" aria-label="Username" aria-describedby="basic-addon1" '+(props[p].required?'required':'')+'>';
                        if(props[p].type=='select'){
                            html+= '<div class="list-group bodyselectedit'+replacetext(" ", "",props[p].label)+data[i].id+'" style="font-size:'+req.set.font_size+';position:absolute;z-index:10;left:95px;top:34px;width:230px; display:none;">';
                            html+='</div>';
                        }
                        
                        html+='</div>';
                    }
                }

         
                html+='</div>';

                html+='<div class="d-grid gap-1 d-flex justify-content-center p-2" style="border-top:1px solid '+req.set.colortema.mid_light+'; background-color:'+req.set.colortema.light+'">';
                html+='<a class="btn save" data-order="edit" data-tabel="'+req.utils.table+'" data-menu="'+req.utils.menu+'" data-idmenu="'+req.utils.idmenu+'" data-id="'+data[i].id+'" data-labels="'+labels.join(',')+'" href="#" type="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+req.set.colortema.secondary+'; color:'+req.set.colortema.dark+'">';
                html+='<i class="fa fa-folder-o"></i> Save';
                html+='</a>';
                html+='</div>';


                html+='</div>';
                html+='</div>';
                html+='</div>';
            }
            html+='</div>';

            $('.bodypreview'+req.query).html(html);
          },
          bestoftahfidz: function(req, tah=null,bul=null,sort=null,sem=null) {
            let th=new Date().getFullYear();
            let bl='0'+(date.getMonth() + 1);
            if((date.getMonth() + 1)<7){
                th=th-1;
            }
            let tahun=(tah==null?th:tah);
            let bulan=(bul==null?bl:bul);
            let sortby=(sort==null?'Semua':sort);
            let semester=(sort==null?'Semua':sem);

            post('dashboard/bestoftahfidz', {
                tahun,bulan,sortby,semester
                 })
                 .then(res => {
                    if(res.status=='200'){
                        let html='';
                        html+='<div class="container">';

                        html+='<form class="d-grid">';
                        html+='<button class="btn cetakraporttahfidz" href="" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:'+res.set.colortema.secondary+'; '+res.set.colortema.dark+'">';
                        html+='<i class="fa fa-print"></i> Cetak Raport';
                        html+='</button>';
                        html+='</form>';
                        html+='<div class="row py-2" style="font-size:'+res.set.font_size+';">';
                        html+='<div style="font-size:'+res.set.font_size+';" class="col-1">NO.</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="col-6 col-md-2">NAMA</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">KELAS</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="col-4 col-md-1">JUZ</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">ADP</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">ADG</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">KTTB</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">ALPHA</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">PLGG</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">NILAI</div>';
                        html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">TOTAL</div>';
                        html+='</div>';
                     for (i = 0; i < res.data.length; i++) {
                           let bg = (i%2==1?res.set.colortema.light:res.set.colortema.secondary);
                            html+='<a href="" style="text-decoration:none; color:'+res.set.colortema.dark+';" data-bs-toggle="modal" data-bs-target="#bestoftahfidz'+res.data[i].user_id+'">';
                            html+='<div class="row py-2" style="font-size:'+res.set.font_size+';background-color:'+bg+'">';
                            html+='<div style="font-size:'+res.set.font_size+';" class="col-1">'+(i+1)+'</div>';
                            html+='<div style="font-size:'+res.set.font_size+';" class="col-6 col-md-2">'+res.data[i].nama+'</div>';
                            html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">'+res.data[i].kelas+'</div>';
                            html+='<div style="font-size:'+res.set.font_size+';" class="col-4 col-md-1">'+res.data[i].keterangan+'</div>';
                            for (let j = 0; j < res.data[i].jumlah.length; j++) {
                             for (let p = 0; p < res.props.length; p++) { 
                                if(res.data[i].jumlah[j].col== res.props[p].col){
                                    html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">'+(res.data[i].jumlah[j].val==null?0:res.data[i].jumlah[j].val)+'</div>';
                                } 
                             }
                            }
                            html+='<div style="font-size:'+res.set.font_size+';" class="d-none col-1 d-md-block">'+res.data[i].total+'</div>';
                            html+='</div>';
                            html+='</a>';


                                  // modal
                            html+='<div class="modal fade" id="bestoftahfidz'+res.data[i].user_id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitLabel" aria-hidden="true">';
                            html+='<div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">';
                            html+='<div class="modal-content">';
                            html+='<div class="modal-header px-3 py-2 d-flex" style="font-size:'+res.set.font_size+'; border-color:'+res.set.colortema.mid_light+'; background-color:'+res.set.colortema.secondary+'">';

                            html+='<div class="p-1"> <i class="fa fa-square" style="font-size:small; color:'+res.set.colortema.mid_dark+'"></i></div>';
                            html+='<div class="p-1">';
                            html+='<p class="modal-title" id="submitLabel">'+res.data[i].nama+'</p>';
                            html+='</div>';
                            html+='<div class="ms-auto p-1"><button type="button" style="font-size:smaller" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';

                            html+='</div>';
                            html+='<div class="modal-body p-2">';
                            html+='<div class="mt-n1 title" style="font-size:'+res.set.font_size+'">Poin</div>';
                            for (let j = 0; j < res.data[i].jumlah.length; j++) {
                                for (let p = 0; p < res.props.length; p++) { 
                                    if(res.data[i].jumlah[j].col== res.props[p].col){
                                        html+='<div class="input-group input-group-sm" style="font-size:'+res.set.font_size+'">';
                                        html+='<span style="font-size:'+res.set.font_size+';background-color:'+res.set.colortema.mid_dark+'; width:40%;background-color:'+res.set.colortema.mid_dark+';border-color:'+res.set.colortema.secondary+'" class="input-group-text" id="basic-addon1">'+res.data[i].jumlah[j].label+'</span>';
                                        html+='<span style="font-size:'+res.set.font_size+'; width:60%;background-color:'+res.set.colortema.mid_light+';border-color:'+res.set.colortema.secondary+'" class="input-group-text" id="basic-addon1">'+(res.data[i].jumlah[j].val==null?0:res.data[i].jumlah[j].val)+'</span>';
                                        html+='</div>';
                                    } 
                                }
                            }
                            html+='<div class="title mt-2" style="font-size:'+res.set.font_size+'">Rata-rata</div>';
                            for (let av = 0; av < res.data[i].avg.length; av++) {
                                for (let p = 0; p < res.props.length; p++) { 
                                   if(res.data[i].avg[av].col== res.props[p].col){
                                    html+='<div class="input-group input-group-sm" style="font-size:'+res.set.font_size+'">';
                                    html+='<span style="font-size:'+res.set.font_size+';background-color:'+res.set.colortema.mid_dark+'; width:40%;background-color:'+res.set.colortema.mid_dark+';border-color:'+res.set.colortema.secondary+'" class="input-group-text" id="basic-addon1">'+res.data[i].avg[av].label+'</span>';
                                    html+='<span style="font-size:'+res.set.font_size+'; width:60%;background-color:'+res.set.colortema.mid_light+';border-color:'+res.set.colortema.secondary+'" class="input-group-text" id="basic-addon1">'+res.data[i].avg[av].val+'</span>';
                                    html+='</div>';
                                   } 
                                }
                               }
                               
                               html+='<div class="title mt-2" style="font-size:'+res.set.font_size+'">Absensi</div>';
                               for (let ab = 0; ab < res.data[i].absen.length; ab++) {
                                    html+='<div class="input-group input-group-sm" style="font-size:'+res.set.font_size+'">';
                                    html+='<span style="font-size:'+res.set.font_size+';background-color:'+res.set.colortema.mid_dark+'; width:40%;background-color:'+res.set.colortema.mid_dark+';border-color:'+res.set.colortema.secondary+'" class="input-group-text" id="basic-addon1">'+res.data[i].absen[ab].col+'</span>';
                                    html+='<span style="font-size:'+res.set.font_size+'; width:60%;background-color:'+res.set.colortema.mid_light+';border-color:'+res.set.colortema.secondary+'" class="input-group-text" id="basic-addon1">'+res.data[i].absen[ab].val+'</span>';
                                    html+='</div>';
                                }
                    
                            html+='</div>';

                            html+='</div>';
                            html+='</div>';
                            html+='</div>';
                        }
                    html+='</div>';
                    $('.bodypreviewprevbesttahfidz').html(html);
                    }
                })
          }
      }
