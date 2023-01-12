import{_ as g}from"./input.b0f6200c.js";import{a as v,r as u,b as w,e as s,t as a,w as b,f as n,h as i,i as x,v as k,j as c,k as V,o as $,l,m as M,p as j}from"./entry.66efff33.js";import{_ as S}from"./button.8d6b0125.js";import{_ as C}from"./language-dropdown.a8e3982d.js";import{u as T,a as U}from"./auth.4e66cf30.js";const A={class:"flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8"},B={class:"sm:mx-auto sm:w-full sm:max-w-md"},K=s("img",{class:"mx-auto h-12 w-auto",src:"https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600",alt:"Your Company"},null,-1),N={class:"mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"},q={class:"mt-8 sm:mx-auto sm:w-full sm:max-w-md"},D={class:"bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10"},O=["onSubmit"],z={class:"flex items-center justify-between"},E={class:"flex items-center"},F={for:"remember-me",class:"ml-2 block text-sm text-gray-900"},H={class:"text-sm"},I={class:"mt-6"},P={class:"relative"},W=s("div",{class:"absolute inset-0 flex items-center"},[s("div",{class:"w-full border-t border-gray-300"})],-1),Y={class:"relative flex justify-center text-sm"},G={class:"px-2 bg-white text-gray-500"},J={class:"mt-6"},L={class:"w-full inline-flex rounded-md shadow-sm"},te={__name:"login",setup(Q){const{t:_}=v(),p=u({color:"emerald"}),o=u({email:"admin@tiny-hands.test",password:"password",rememberMe:"",busy:!1,onKeydown(e){this.errors.props=[]},params(){return{email:this.email,password:this.password,remember:this.rememberMe}},errors:{props:[],has(e){var t;return(t=Object.prototype.hasOwnProperty.call(this.props,e))!=null?t:!1},get(e){return this.has(e)?Array.isArray(this.props[e])?this.props[e][0]:this.props[e]:null}},async post(e){try{this.busy=!0;const t=await T(e,{method:"post",body:this.params()});return this.busy=!1,t}catch(t){this.busy=!1,this.errors.props=t.data.errors}}});async function h(){const e=U(),t=await o.value.post("/login");if(t){e.saveToken(t.token,o.value.rememberMe);const m=await e.fetchUser();return M({title:_("login_successful"),text:"Welcome "+m.display_name,type:"success",duration:5e3}),j({name:"index"})}}return(e,t)=>{const m=g,f=V,d=S,y=C;return $(),w("div",A,[s("div",B,[K,s("h2",N,a(e.$t("log_in_to_your_account")),1)]),s("div",q,[s("div",D,[s("form",{class:"space-y-6",action:"#",onSubmit:b(h,["prevent"]),onKeydown:t[3]||(t[3]=r=>o.value.onKeydown(r))},[n(m,{modelValue:o.value.email,"onUpdate:modelValue":t[0]||(t[0]=r=>o.value.email=r),errors:o.value.errors,"error-key":"email",required:"",name:"email",type:"email"},{default:i(()=>[l(a(e.$t("email_address")),1)]),_:1},8,["modelValue","errors"]),n(m,{modelValue:o.value.password,"onUpdate:modelValue":t[1]||(t[1]=r=>o.value.password=r),errors:o.value.errors,"error-key":"email",required:"",name:"password",type:"password"},{default:i(()=>[l(a(e.$t("password")),1)]),_:1},8,["modelValue","errors"]),s("div",z,[s("div",E,[x(s("input",{id:"remember-me","onUpdate:modelValue":t[2]||(t[2]=r=>o.value.rememberMe=r),name:"remember-me",type:"checkbox",class:c(["h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"])},null,512),[[k,o.value.rememberMe]]),s("label",F,a(e.$t("remember_me")),1)]),s("div",H,[n(f,{to:"/password/reset",class:c([p.value?"text-indigo-600 hover:text-indigo-500":"","font-medium "])},{default:i(()=>[l(a(e.$t("forgot_password")),1)]),_:1},8,["class"])])]),s("div",null,[n(d,{loading:o.value.busy,"loading-text":e.$t("logging_in_to_your_account")},{default:i(()=>[l(a(e.$t("log_in_to_your_account")),1)]),_:1},8,["loading","loading-text"])])],40,O),s("div",I,[s("div",P,[W,s("div",Y,[s("span",G,a(e.$t("dont_have_an_account")),1)])]),s("div",J,[s("div",null,[s("span",L,[n(d,{"native-type":"button",type:"secondary"},{default:i(()=>[l(a(e.$t("register_an_account")),1)]),_:1})])])])])]),n(y,{"show-label":!0})])])}}};export{te as default};
