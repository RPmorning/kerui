layui.use(['form'], function(){
    var form = layui.form(),
        layer = layui.layer;

   form.on('submit(login)', function(data){
       if(data.field.username == '' || data.field.username == '请输入用户名'){
           layer.msg('请输入用户名',{time:2000},function () {
               return false;
           })
       }else if(data.field.password == '' || data.field.password == '请输入用户名'){
           layer.msg('请输入密码',{time:2000},function () {
               return false;
           })
       }else if(data.field.verification == '' || data.field.password == '请输入验证码'){
           layer.msg('请输入用验证码',{time:2000},function () {
               return false;
           })
       } else{
           $.post("/admin/passport/dologin", data.field,  function (result) {
               if (result.code == 1) {
                   layer.msg(result.msg, {time: 2000}, function () {
                       window.location.replace(result.url);
                   });
               } else {
                   layer.msg(result.msg, {time:2000}, function () {
                       return false;
                   });
               }
               // layer.msg(result.msg, {time:2000}, function () {
               //     if(result.code) window.location.replace(result.url);
               // });
           });
       }
        return false;
    });
});

// function token(uname,upwd) {
//     var app_id="demo";
//     var pks2="-----BEGIN PUBLIC KEY-----\n" +
//         "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCzA+mdwLl/Y/QPy9xTVsvrNt0B\n" +
//         "7hCVRwu+Abt3ebgQTOMy66iS/zPkl3Cx2H9lAaFl4UkaRN3hrVJ3O70fnzvTR1P7\n" +
//         "Cx+UXyeM1IPew1YTWQtaWIxaKbYxiCpMJsZ5KDs+POFRPF6CDvf6gsCu5QwdauxF\n" +
//         "bhBTut6ncrOYPCB3GwIDAQAB\n" +
//         "-----END PUBLIC KEY-----";
//
//     //var $this = $(this);
//     //e.preventDefault();
//     //event.preventDefault();
//     var username =uname;// $this.find("input[name='username']").val();
//     var password = upwd;//$this.find("input[name='password']").val();
//     var user = '{"username":"'+ username +'","password":"'+ password +'"}';
//     //RSA加密
//     var encrypt = new JSEncrypt();
//     encrypt.setPublicKey(pks2);
//     var encrypted = encrypt.encrypt(user);
//     $.ajax({
//         type: 'post',
//         url: '/api/index/login',
//         dataType: "json",
//         data: {
//             app_id: app_id,
//             user:encrypted},
//         success: function(data){
//             ticket = data.data.ticket;
//             //document.cookie="ticket=11";
//             //document.cookie = 'name=guoqian';
//
//             $.cookie('ticket', ticket, { path: "/",expires: 7 });
//             //localStorage.ticket=ticket;
//         },
//
//     });
// }
particlesJS("particles-js", {
    "particles": {
        "number": {
            "value": 80,
            "density": {
                "enable": true,
                "value_area": 800
            }
        },
        "color": {
            "value": "#ffffff"
        },
        "shape": {
            "type": "circle",
            "stroke": {
                "width": 0,
                "color": "#000000"
            },
            "polygon": {
                "nb_sides": 5
            },
            "image": {
                "src": "img/github.svg",
                "width": 100,
                "height": 100
            }
        },
        "opacity": {
            "value": 0.3,
            "random": false,
            "anim": {
                "enable": false,
                "speed": 1,
                "opacity_min": 0.1,
                "sync": false
            }
        },
        "size": {
            "value": 3,
            "random": true,
            "anim": {
                "enable": false,
                "speed": 40,
                "size_min": 0.1,
                "sync": false
            }
        },
        "line_linked": {
            "enable": true,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.3,
            "width": 1
        },
        "move": {
            "enable": true,
            "speed": 6,
            "direction": "none",
            "random": false,
            "straight": false,
            "out_mode": "out",
            "bounce": false,
            "attract": {
                "enable": false,
                "rotateX": 600,
                "rotateY": 1200
            }
        }
    },
    "interactivity": {
        "detect_on": "canvas",
        "events": {
            "onhover": {
                "enable": true,
                "mode": "grab"
            },
            "onclick": {
                "enable": true,
                "mode": "push"
            },
            "resize": true
        },
        "modes": {
            "grab": {
                "distance": 100,
                "line_linked": {
                    "opacity": 1
                }
            },
            "bubble": {
                "distance": 200,
                "size": 40,
                "duration": 2,
                "opacity": 8,
                "speed": 3
            },
            "repulse": {
                "distance": 100,
                "duration": 0.4
            },
            "push": {
                "particles_nb": 4
            },
            "remove": {
                "particles_nb": 2
            }
        }
    },
    "retina_detect": true
});




