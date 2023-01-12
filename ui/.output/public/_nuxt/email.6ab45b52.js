import{_}from"./input.b0f6200c.js";import{_ as h}from"./button.8d6b0125.js";import{_ as f}from"./language-dropdown.a8e3982d.js";import{a as y,r as w,b as g,e,t as a,w as v,f as n,h as l,o as x,l as d,m as b,p as $}from"./entry.66efff33.js";import{u as V}from"./auth.4e66cf30.js";const k={class:"flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8"},S={class:"sm:mx-auto sm:w-full sm:max-w-md"},T=e("img",{class:"mx-auto h-12 w-auto",src:"https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600",alt:"Your Company"},null,-1),B={class:"mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"},K={class:"mt-2 text-center text-sm text-gray-600"},N={class:"mt-8 sm:mx-auto sm:w-full sm:max-w-md"},j={class:"bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10"},A=["onSubmit"],C={class:"mt-6"},O={class:"relative"},P=e("div",{class:"absolute inset-0 flex items-center"},[e("div",{class:"w-full border-t border-gray-300"})],-1),q={class:"relative flex justify-center text-sm"},D={class:"px-2 bg-white text-gray-500"},E={class:"mt-6"},F={class:"w-full inline-flex rounded-md shadow-sm"},G={__name:"email",setup(H){const{t:u}=y(),o=w({email:"",busy:!1,onKeydown(s){this.errors.props=[]},params(){return{email:this.email}},errors:{props:[],has(s){var t,r;return(r=(t=this.props)==null?void 0:t.hasOwnProperty(s))!=null?r:!1},get(s){return this.has(s)?Array.isArray(this.props[s])?this.props[s][0]:this.props[s]:null}},async post(s){try{this.busy=!0;const t=await V(s,{method:"POST",body:this.params()});return this.busy=!1,t}catch(t){this.busy=!1,t.data.errors!==void 0?this.errors.props=t.data.errors:this.errors.props=t.data}}});async function c(){const s=await o.value.post("/password/email");if(!o.value.errors.props.length)return b({title:u("successful"),text:s.status,type:"success",duration:5e3}),$({name:"index"})}return(s,t)=>{const r=_,m=h,p=f;return x(),g("div",k,[e("div",S,[T,e("h2",B,a(s.$t("reset_your_password")),1),e("p",K,a(s.$t("reset_your_password_description")),1)]),e("div",N,[e("div",j,[e("form",{class:"space-y-6",action:"#",onSubmit:v(c,["prevent"]),onKeydown:t[1]||(t[1]=i=>o.value.onKeydown(i))},[n(r,{modelValue:o.value.email,"onUpdate:modelValue":t[0]||(t[0]=i=>o.value.email=i),errors:o.value.errors,"error-key":"email",required:"",name:"email",type:"email"},{default:l(()=>[d(a(s.$t("email_address")),1)]),_:1},8,["modelValue","errors"]),e("div",null,[n(m,{loading:o.value.busy,"loading-text":s.$t("sending_password_reset_email")},{default:l(()=>[d(a(s.$t("send_password_reset_email")),1)]),_:1},8,["loading","loading-text"])])],40,A),e("div",C,[e("div",O,[P,e("div",q,[e("span",D,a(s.$t("dont_have_an_account")),1)])]),e("div",E,[e("div",null,[e("span",F,[n(m,{"native-type":"button",type:"secondary"},{default:l(()=>[d(a(s.$t("register_an_account")),1)]),_:1})])])])])]),n(p,{"show-label":!0})])])}}};export{G as default};
