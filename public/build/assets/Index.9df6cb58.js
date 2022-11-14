import{l as w,u as y,q as V,o as d,g as n,a as i,d as e,w as m,b as t,t as u,k as c,h as f,s as b,n as p,x as k,e as x,f as $,F as U,L as h,z as j}from"./app.411a74f6.js";import{_ as C}from"./AdminLayout.81de5f70.js";import{_ as g,a as N}from"./Upload.489d82cc.js";import"./Sidebar.d48ffcb9.js";const B={class:"flex flex-row justify-between items-center h-32"},D=e("h3",{class:"text-red-500 font-bold text-lg"},"\u0627\u0641\u0632\u0648\u062F\u0646 \u062C\u0648\u0627\u06CC\u0632 \u0648 \u0627\u0641\u062A\u062E\u0627\u0631\u0627\u062A",-1),F={class:"flex flex-row gap-5"},M=e("div",{class:"py-12"},[e("nav",{class:"flex border-b border-gray-100 text-sm font-medium"},[e("a",{href:"",class:"-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"}," \u0645\u0634\u062E\u0635\u0627\u062A "),e("a",{href:"",class:"-mb-px font-base border-current p-4 text-black"}," \u062A\u0635\u0627\u0648\u06CC\u0631 ")])],-1),S={key:0,class:"text-red-500 border-red-500 bg-red-50 border p-5 rounded-lg mb-10 duration-1000"},z={key:1,class:"text-emerald-500 border-green-500 bg-emerald-50 border p-5 rounded-lg mb-10 duration-1000"},H={class:"flex flex-col lg:flex-row jutfiy-start items-start gap-4"},L={class:"w-full lg:w-3/4 flex flex-col gap-4"},O={class:"p-5 rounded-xl bg-slate-100 grid"},T=e("h1",{class:"font-black text-neutral-600"},"\u0645\u0634\u062E\u0635\u0627\u062A",-1),q={class:"grid grid-cols-1 gap-8 m-5 mt-10"},E={class:"flex flex-col gap-4"},I=e("label",{class:"text-sm text-slate-600"},"\u0646\u0627\u0645",-1),P={key:0,class:"text-xs text-red-600"},A={class:"flex flex-col gap-4"},G=e("label",{class:"text-sm text-slate-600"},"\u062A\u0648\u0636\u06CC\u062D\u0627\u062A",-1),J={key:0,class:"text-xs text-red-600"},K={class:"flex flex-col gap-4"},Q=e("label",{class:"text-sm text-slate-600"},"\u0646\u0648\u0639",-1),R=e("option",{selected:""},"\u0646\u0648\u0639 \u062C\u0627\u06CC\u0632\u0647 \u0631\u0627 \u0627\u0646\u062A\u062E\u0627\u0628 \u06A9\u0646\u06CC\u062F",-1),W=e("option",{value:"award"},"\u062C\u0627\u06CC\u0632\u0647",-1),X=e("option",{value:"competition"},"\u0645\u0633\u0627\u0628\u0642\u0647",-1),Y=[R,W,X],Z={key:0,class:"text-xs text-red-600"},ee={class:"p-5 rounded-xl bg-slate-100 grid"},se=e("h1",{class:"font-black text-neutral-600"},"\u062A\u0635\u0627\u0648\u06CC\u0631",-1),te={class:"flex flex-row justify-start items-start gap-4 mt-5"},oe={class:"w-full lg:w-1/4 p-5 rounded-xl bg-slate-100"},le=e("h3",null,"\u0630\u062E\u06CC\u0631\u0647",-1),re={class:"flex flex-col gap-4"},ae=["disabled"],de={layout:C},fe=Object.assign(de,{__name:"Index",props:{errors:Object},setup(r){const _=w(()=>j().props.value.auth.user);console.log(_.value);const o=y({title:null,description:null,type:null,status:!0,image_id:null,cover_id:null});return(a,s)=>{const v=V("Head");return d(),n(U,null,[i(v,{title:"User"}),e("form",{onSubmit:s[6]||(s[6]=$(l=>t(o).post("/admin/user"),["prevent"]))},[e("div",B,[D,e("div",F,[i(t(h),{class:"px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in",as:"div",href:"#"},{default:m(()=>[x("\u0645\u0634\u0627\u0647\u062F\u0647 \u0644\u06CC\u0633\u062A ")]),_:1}),i(t(h),{class:"px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in",as:"div",href:"#"},{default:m(()=>[x("\u0627\u0641\u0632\u0648\u062F\u0646 \u0645\u062C\u0645\u0648\u0639\u0647 \u062C\u062F\u06CC\u062F ")]),_:1})])]),M,a.$page.props.flash.error?(d(),n("div",S,u(a.$page.props.flash.error),1)):c("",!0),a.$page.props.flash.success?(d(),n("div",z,u(a.$page.props.flash.success),1)):c("",!0),e("div",H,[e("div",L,[e("div",O,[T,e("div",q,[e("div",E,[I,f(e("input",{class:p(["bg-neutral-200/50 rounded-xl outline-0 w-full p-3 focus:shadow-inner focus:shadow-slate-200 text-slate-500",{"border-red-500 border bg-red-50":r.errors.title}]),"onUpdate:modelValue":s[0]||(s[0]=l=>t(o).title=l)},null,2),[[b,t(o).title]]),r.errors.title?(d(),n("div",P,u(r.errors.title),1)):c("",!0)]),e("div",A,[G,f(e("textarea",{rows:"6",class:p(["bg-neutral-200/50 rounded-xl outline-0 w-full p-3 focus:shadow-inner focus:shadow-slate-200 text-slate-500",{"border-red-500 border bg-red-50":r.errors.description}]),"onUpdate:modelValue":s[1]||(s[1]=l=>t(o).description=l)},null,2),[[b,t(o).description]]),r.errors.description?(d(),n("div",J,u(r.errors.description),1)):c("",!0)]),e("div",K,[Q,f(e("select",{"onUpdate:modelValue":s[2]||(s[2]=l=>t(o).type=l),class:p([{"border-red-500 border bg-red-50":r.errors.type},"max-w-sm bg-neutral-200/50 rounded-xl outline-0 w-full p-2 pe-10 focus:shadow-inner focus:shadow-slate-200 text-slate-500"])},Y,2),[[k,t(o).type]]),r.errors.type?(d(),n("div",Z,u(r.errors.type),1)):c("",!0)])])]),e("div",ee,[se,e("div",te,[i(g,{modelValue:a.image_id,"onUpdate:modelValue":s[3]||(s[3]=l=>a.image_id=l)},null,8,["modelValue"]),i(g,{modelValue:a.cover_id,"onUpdate:modelValue":s[4]||(s[4]=l=>a.cover_id=l)},null,8,["modelValue"])])])]),e("div",oe,[le,e("div",re,[i(N,{modelValue:t(o).status,"onUpdate:modelValue":s[5]||(s[5]=l=>t(o).status=l)},null,8,["modelValue"]),x(" "+u(t(o).status),1)]),e("div",null,[e("button",{type:"submit",disabled:t(o).processing||!t(o).isDirty,class:"disabled:bg-slate-400 w-full space-x-5 py-2 text-center rounded-full bg-teal-500 text-white mt-10"}," \u0630\u062E\u06CC\u0631\u0647 ",8,ae)])])])],32)],64)}}});export{fe as default};