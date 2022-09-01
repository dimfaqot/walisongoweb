$(document).ready(function(){
body();
preview();


$(document).on('keyup', '.select', function(e) {
    e.preventDefault();
    let format = $(this).data('format');
    let order = $(this).data('order');
    let type = $(this).data('type');
    let label = $(this).data('label');
    let datamulti = $(this).data('datamulti');
    let col = $(this).data('col');
    let cols = $(this).data('cols');
    let query = $(this).data('query');
    let menu = $(this).data('menu');
    let id = $(this).data('id');
    let val = $(this).val();

    if(order=='search'){
        body(order,val);
        
    }else if(order=='dokumen'){
        post('dashboard/select', {
            val,order,menu, id:''
         })
         .then(res => {
            // console.log(res.data.data)
        dokumen(res.data);  
     })
    }else {
        $('.bodyselect'+order+label+(order=='edit'?id:'')).show();
        post('dashboard/select', {
            menu,query,val,order,type,cols,datamulti
         })
         .then(res => {
           // console.log(res.data)
        selectdb(order,label,format,res.data, id,datamulti);
     })
        
    }

});

$(document).on('click', '.insert', function(e) {
    e.preventDefault();
    let datamulti = $(this).data('datamulti').split(",");
    let order = $(this).data('order');
    let label = $(this).data('label');
    let format = $(this).data('format');
    let id = $(this).data('id');
    let val = $(this).data('val');
    let coltext = $(this).data('coltext');
    // console.log(coltext);

    $('.bodyselect'+order+label+(order=='edit'?id:'')).hide();
    $('.'+order+label+(order=='edit'?id:'')).val(coltext);
    $('.'+order+label+(order=='edit'?id:'')).attr('data-val', val);
        if(format=='multi'){
            for (let i = 0; i < datamulti.length; i++) {
                $('.'+order+datamulti[i]+(order=="edit"?id:'')).val($(this).data(datamulti[i].toLowerCase()));
            }
        }
});

$(document).on('click', '.clearsearch', function(e) {
    e.preventDefault();
    let order = $(this).data('order');
    let label = $(this).data('label');
    let id = $(this).data('id');
    let oldval=$('.'+order+label+id).data('oldval');

    $('.bodyselect'+order+label+(order=='edit'?id:'')).hide();
    $('.'+order+label+(order=='edit'?id:'')).val((order=='edit'?oldval:''));
        
});

$(document).on('click', '.btnlists', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    let order = $(this).data('order');

        if($('.headerlist'+order+id).hasClass('bgactive')){
            $('.headerlist'+order+id).removeClass('bgactive')
        }else{
            $('.headerlist'+order+id).addClass('bgactive')
        }
        
});


$(document).on('keyup', '.rows', function(e) {
    e.preventDefault();
    let val = $(this).val();
    let idmenu = $(this).data('idmenu');

    post('dashboard/rows', {
      val,idmenu
     })
     .then(res => {
        if(res.status=='200'){
            (val==''?'':sukses())
            body();
        }
    })
        
});

    $(document).on('click', '.save', function(e) {
        e.preventDefault();
        let tabel = $(this).data('tabel');
        let order = $(this).data('order');
        let id = $(this).data('id');
        let idmenu = $(this).data('idmenu');
        let labels = $(this).data('labels').split(",");


        let data = {};
        for (let i = 0; i < labels.length; i++) {
     
            let type = $('.' + order + labels[i] + (order == 'edit' ? id : '')).data('type');

            let placeholder = $('.' + order + labels[i] + (order == 'edit' ? id : '')).attr('placeholder');
            let col = $('.' + order + labels[i] + (order == 'edit' ? id : '')).attr('name');   
            let casetext = $('.' + order + labels[i] + (order == 'edit' ? id : '')).data('case'); 

            let val = $('.' + order + labels[i] + (order == 'edit' ? id : '')).val();
            let prop = $('.' + order + labels[i] + (order == 'edit' ? id : '')).prop('required');

            if (type=='select') {
                val=$('.' + order + labels[i] + (order == 'edit' ? id : '')).data('val');
            }
            if (type=='radio' || type=='checkbox') {
                val=$('input[name="' + order + labels[i] + (order == 'edit' ? id : '') + '"]:checked').val();
                col=$('.' + order + labels[i] + (order == 'edit' ? id : '')).data('col')
                placeholder=$('.' + order + labels[i] + (order == 'edit' ? id : '')).data('label')
            }

            let exp=col.split("_");
            if (exp[exp.length - 1] === 'id') {
                val=$('.' + order + labels[i] + (order == 'edit' ? id : '')).data('val');
           
            }
            if (prop) {
                if (val == "" || val == undefined) {
                    gagal(placeholder + ' harus diisi!.')
                    return false;
                }
            }
            
            data[col] = {
                'case': casetext,
                'val': (val===undefined?0:val)
            };
        }

        if(tabel=='tahfidz'){
            // console.log(data)
            let exp=data.keterangan.val.toLowerCase().split(" ");

            let juz="0";
            let hal="0";
            if (exp.indexOf("juz") >=0){
                juz=exp[exp.indexOf("juz")+1];
            }
            if (exp.indexOf("halaman") >=0){
                hl=exp[exp.indexOf("halaman")+1];
                let exp2=hl.split('-');
                hal=exp2[0];
                if(exp2.length>1){
                    hal=exp2[1];
                }

            }
            if (exp.indexOf("hal") >=0){
                hl=exp[exp.indexOf("hal")+1];
                let exp2=hl.split('-');
                hal=exp2[0];
                if(exp2.length>1){
                    hal=exp2[1];
                }

            }
           data['juz']={
            'case':'no',
            'val':(juz==0?0:juz+hal)
           }
          }

        post('dashboard/save', {
        data,tabel,order,idmenu,id
        })
        .then(res => {
            if(res.status=='200'){
                sukses(res.reload)
                body();

                if(order=='edit'){
                  if(tabel=='tahfidz' || tabel=='wifa'){
                    $('#absen'+tabel+id).modal('hide');
                    preview();
                    previewfunc.bestoftahfidz(null,null,null,null);
                  }
                    setTimeout(() => {
                     $('#panelsStayOpen-collapse'+id).addClass('show');
                     $('.headerlistedit'+id).addClass('bgactive');
                    }, 2000);
                }
                if(order=='submit'){
                   $('.submit').val('');
                   $('#submit').modal('hide');
                }
                if(order=='copy'){
                    $('#'+order).offcanvas('hide');
                }
            }
        })
            
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let idmenu = $(this).data('idmenu');
        let tabel = $(this).data('tabel');
    
        post('dashboard/delete', {
          id,tabel,idmenu
         })
         .then(res => {
            if(res.status=='200'){
                $('#konfirmasi'+id).modal('hide');
                sukses(res.reload);
                body();
            }else{
                gagal(res.message);
            }
        })
            
    });
    $(document).on('click', '.click', function(e) {
        e.preventDefault();
        let query=$(this).data('query');
        let order=$(this).data('order');
        let label=$(this).data('label');
        let id=$(this).data('id');
        let img = $(this).css('background-image');
        img = img.replace('url(','').replace(')','').replace(/\"/gi, "");
       $('.download').attr('href', img);
       $('.bodyzoom').attr('src', img);

        let modal = new bootstrap.Modal(document.getElementById(query), {
            keyboard: false
          });
          modal.show();

          $('.insertclick'+query).attr('data-label', label);
          $('.insertclick'+query).attr('data-order', order);
          $('.insertclick'+query).attr('data-id', id);
            
    });


    $(document).on('click', '.insertclick', function(e) {
        e.preventDefault();
            let format=$(this).data('format');
            let order=$(this).data('order');
            let val=$(this).data('val');
            let label=$(this).data('label');
            let id=$(this).data('id');

            $('.'+order+label+(order=='edit'?id:'')).val(val);


            $('#'+format).modal('hide');
        
    });

    $(document).on('click', '.btnclose', function(e) {
        e.preventDefault();
        $('.gagal').fadeOut();
    });

    $(document).on('change', '.inputdokumen', function(e) {
        e.preventDefault();
        let label = $(this).data('label');
        let order = $(this).data('order');
        let id = $(this).data('id');
        let tmppath = URL.createObjectURL(e.target.files[0]);
        $('.'+order+label+id).css('background-image','url('+tmppath+')');
    });

    $(document).on('click', '.loadmore', function(e) {
        e.preventDefault();
        let query = $(this).data('query');
        let order = $(this).data('order');
        let menu = $(this).data('menu');
        post('dashboard/loadmore', {
            query,order,menu
           })
           .then(res => {
              if(res.status=='200'){
                console.log(res);
                  sukses(res.reload);
                  preview(res.data);
              }else{
                  gagal(res.message);
              }
          })
    });

    $(document).on('click', '.copy', function(e) {
        e.preventDefault();
      let id=$(this).data('id');
      let tabel=$(this).data('tabel');
      let order=$(this).data('order');
      let menu=$(this).data('menu');
        post('dashboard/copy', {
            id,tabel,menu
           })
           .then(res => {
              if(res.status=='200'){
                copy(res)
                let canvas = document.getElementById(order)
                let bsOffcanvas = new bootstrap.Offcanvas(canvas)
                bsOffcanvas.show()
              }
          })
    });
    $(document).on('change', '.fontsize', function(e) {
        e.preventDefault();
       let val=$(this).data('val');
        post('dashboard/fontsize', {
            val
           })
           .then(res => {
              if(res.status=='200'){
                sukses(res.reload);
              }
          })
    });
    $(document).on('click', '.colortema', function(e) {
        e.preventDefault();
       let id=$(this).data('id');
       console.log(id);
        post('dashboard/colortema', {
            id
           })
           .then(res => {
              if(res.status=='200'){
                sukses(res.reload);
              }
          })
    });

    let cols=[];
    let colselected=[];
    let selected=[];
    $(document).on('change', '.changepreview', function(e) {
        e.preventDefault();
        let type=$(this).data('type');
        let query=$(this).data('query');
        let menu=$(this).data('menu');
        let val = $(this).val();

        if(type=='select'){
           selected =  $("select.changepreview").map(function(){ return {'req':this.id,'val':this.value} }).get();
        }else{
            cols =  $("input[type='checkbox'][name='changepreview']").map(function(){ return {'col':this.id,'val':this.value} }).get();
            (colselected.indexOf(val) === -1 ? colselected.push(val) : colselected.splice(cols.indexOf(val), 1));
        }
        
        let newcol=[];
        for (let i = 0; i < cols.length; i++) {
            let val={'col':cols[i].col, 'val':'off'}
            for (let c = 0; c < colselected.length; c++) {
                if(cols[i].col==colselected[c]){
                    val={'col':colselected[c], 'val':'on'};
                }    
            }   
            newcol.push(val);  
        }
        cols=newcol

        // return false;
        post('dashboard/changepreview', {
           cols,selected,query,menu
           })
           .then(res => {
              if(res.status=='200'){
                sukses(res.reload);
                preview(res.data);
              }
          })
    });

    $(document).on('click', '.hapus', function(e) {
        e.preventDefault();
       let id=$(this).data('id');
       let query=$(this).data('query');
       $('.header'+query+id).remove();
       $('#body'+query+id).remove();
    });


    $(document).on('keyup', '.caripreview', function(e) {
        e.preventDefault();
        let query=$(this).data('query');
        let value = $(this).val().toLowerCase();

        $('.' + query ).filter(function() {
        $(this).toggle($(this).data('lists').toLowerCase().indexOf(value) > -1);
    });
    });

    let props='';
    let set='';
    $(document).on('keyup', '.selectpreview', function(e) {
        e.preventDefault();
        let cols=$(this).data('cols');
        let query=$(this).data('query');
        let menu=$(this).data('menu');
        let val = $(this).val();

        post('dashboard/selectpreview', {
            cols,val,menu
            })
            .then(res => {
               if(res.status=='200'){
                props=res.data.props;
                set=res.data.set;
              selectpreview(res.data.data,cols.split(","),res.data.set,query);
               }
           })

    });

    $(document).on('click', '.insertpreview', function(e) {
        e.preventDefault();
       let cols=$(this).data('cols').split(",");
       let query=$(this).data('query');
       let data={};
       for (let i = 0; i < cols.length; i++) {
            data[[cols[i]]]=$(this).data(cols[i]);      
       }

      insertpreview(props,set,data,query)
    });
    
    $(document).on('click', '.clearsearchpreview', function(e) {
        e.preventDefault();
      
            $('.selectpreview').val('');
            $('.bodyselectpreview').hide();
    });

    $(document).on('click', '.printself', function(e) {
        e.preventDefault();

        let query=$(this).data('query');
        let menu=$(this).data('menu');
        let cols=$(this).data('cols');
        let controller=$(this).data('controller');


        $('#form').attr('method', 'post');
        $('#form').attr('action', controller);
        $('#form').attr('target', "_blank");


        let html = '';
        html += '<input type="hidden" name="query" value="' + query + '">';
        html += '<input type="hidden" name="controller" value="' + controller + '">';
        html += '<input type="hidden" name="menu" value="' + menu + '">';
        html += '<input type="hidden" name="orientasi" value="' + $('.orientasi'+query).val() + '">';
        html += '<input type="hidden" name="cols" value="' + $('.cols'+query).val() + '">';
        html += '<input type="hidden" name="judul" value="' + $('.judul'+query).val() + '">';
        cols = cols.split(",");

        let vals=[];
        for (let i = 0; i < cols.length; i++) {
            $('.' +query+ cols[i]).each(function() {
                vals.push({'col':cols[i], 'val':this.value});
            })
        }
        for (let c = 0; c < cols.length; c++) {
            for (let x = 0; x < vals.length; x++) {
                if(cols[c]==vals[x].col)
                html += '<input type="hidden" name="'+vals[x].col+'[]" value="' + vals[x].val + '">';
                
            }
        }
        
        $("#bodyform").html(html);
        $("#form").submit()
    });

    $(document).on('click', '.createabsen', function(e) {
        e.preventDefault();
        let tabel=$(this).data('tabel');
        let menu=$(this).data('menu');

        post('dashboard/createabsen', {
           tabel,menu
            })
            .then(res => {
               if(res.status=='200'){
                sukses(false);
                preview();
               }
           })
    });

    $(document).on('change', '.bestoftahfidz', function(e) {
        e.preventDefault();
        let tahun=$('#tahunbestoftahfidz').val();
        let bulan=$('#bulanbestoftahfidz').val();
        let sortby=$('#sortbybestoftahfidz').val();
        let semester=$('#semesterbestoftahfidz').val();

        previewfunc.bestoftahfidz(null,tahun,bulan,sortby,semester);

    });


})