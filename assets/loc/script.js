(function(){
  const $=(s,r=document)=>r.querySelector(s), $$=(s,r=document)=>[...r.querySelectorAll(s)];
  const toast=(m)=>{const t=$('#toast');t.textContent=m;t.classList.add('show');clearTimeout(t._h);t._h=setTimeout(()=>t.classList.remove('show'),2000)};

  /* Mobile menu */
  const burger=$('#burger'), menu=$('#mobileMenu'), top=$('#top');
  const setMenu=(open)=>{menu.hidden=!open;burger.setAttribute('aria-expanded',open);top.classList.toggle('menu-open',open);burger.setAttribute('aria-label',open?'Close menu':'Open menu')};
  burger.addEventListener('click',()=>setMenu(menu.hidden));
  $$('a',menu).forEach(a=>a.addEventListener('click',()=>setMenu(false)));
  addEventListener('resize',()=>{if(innerWidth>1060&&!menu.hidden)setMenu(false)});

  /* Coupon copy */
  $('#copyBtn').addEventListener('click',()=>{
    const code='CK-10OFF';
    try{navigator.clipboard.writeText(code).then(()=>toast('Code copied: '+code),()=>sel())}catch(e){sel()}
    function sel(){const r=document.createRange();r.selectNodeContents($('#coupon'));const s=getSelection();s.removeAllRanges();s.addRange(r);toast('Code selected, press Ctrl/Cmd+C')}
  });

  /* Count-up (final values already in markup) */
  const reduce=matchMedia('(prefers-reduced-motion: reduce)').matches;
  if(!reduce && 'IntersectionObserver' in window){
    const io=new IntersectionObserver(es=>es.forEach(e=>{
      if(!e.isIntersecting)return; io.unobserve(e.target);
      const el=e.target, end=parseFloat(el.dataset.count), dec=+(el.dataset.dec||0), t0=performance.now(), d=1400;
      const fmt=v=>dec?v.toFixed(dec):Math.round(v).toLocaleString('en-IN');
      const step=t=>{const p=Math.min(1,(t-t0)/d), k=1-Math.pow(1-p,3); el.textContent=fmt(end*k); if(p<1)requestAnimationFrame(step); else el.textContent=fmt(end)};
      requestAnimationFrame(step);
    }),{threshold:.6});
    $$('[data-count]').forEach(el=>io.observe(el));
  }

  /* Course rail: arrows, scrubber, drag, filters */
  const rail=$('#courseRail'), bar=$('#railBar'), prev=$('#cPrev'), next=$('#cNext');
  const by=(r,dir)=>{const card=[...r.children].find(c=>!c.hidden); const w=card?card.getBoundingClientRect().width+22:320; r.scrollBy({left:dir*w,behavior:reduce?'auto':'smooth'})};
  prev.onclick=()=>by(rail,-1); next.onclick=()=>by(rail,1);
  rail.addEventListener('keydown',e=>{if(e.key==='ArrowRight'){by(rail,1);e.preventDefault()}if(e.key==='ArrowLeft'){by(rail,-1);e.preventDefault()}});
  const upd=()=>{const max=rail.scrollWidth-rail.clientWidth; const vis=Math.min(1,rail.clientWidth/rail.scrollWidth); bar.style.width=(vis*100)+'%'; bar.style.transform='translateX('+(max>0?(rail.scrollLeft/max)*((1-vis)/vis)*100:0)+'%)'; prev.disabled=rail.scrollLeft<4; next.disabled=rail.scrollLeft>max-4};
  rail.addEventListener('scroll',upd,{passive:true}); addEventListener('resize',upd); upd();
  const scrub=$('#scrub'); let sd=false;
  const seek=e=>{const r=scrub.getBoundingClientRect();const k=Math.max(0,Math.min(1,(e.clientX-r.left)/r.width));rail.scrollLeft=k*(rail.scrollWidth-rail.clientWidth)};
  scrub.addEventListener('pointerdown',e=>{sd=true;scrub.setPointerCapture(e.pointerId);rail.style.scrollSnapType='none';seek(e)});
  scrub.addEventListener('pointermove',e=>{if(sd)seek(e)});
  scrub.addEventListener('pointerup',()=>{sd=false;rail.style.scrollSnapType=''});
  scrub.addEventListener('keydown',e=>{if(e.key==='ArrowRight'){by(rail,1);e.preventDefault()}if(e.key==='ArrowLeft'){by(rail,-1);e.preventDefault()}});
  rail.addEventListener('scroll',()=>{const m=rail.scrollWidth-rail.clientWidth;scrub.setAttribute('aria-valuenow',m>0?Math.round(rail.scrollLeft/m*100):0)},{passive:true});
  let dx=null,sl=0,moved=false;
  rail.addEventListener('pointerdown',e=>{if(e.pointerType!=='mouse')return;dx=e.clientX;sl=rail.scrollLeft;moved=false});
  addEventListener('pointermove',e=>{if(dx===null)return;const d=e.clientX-dx;if(Math.abs(d)>5){moved=true;rail.classList.add('dragging')}if(moved)rail.scrollLeft=sl-d});
  addEventListener('pointerup',()=>{if(dx===null)return;dx=null;rail.classList.remove('dragging')});
  rail.addEventListener('click',e=>{if(moved){e.preventDefault();moved=false}},true);
  $$('.cf-chip').forEach(ch=>ch.addEventListener('click',()=>{
    const f=ch.dataset.f; $$('.cf-chip').forEach(x=>{const on=x===ch;x.classList.toggle('on',on);x.setAttribute('aria-pressed',on)});
    let n=0; $$('.course',rail).forEach(c=>{const show=f==='all'||c.dataset.cat===f;c.hidden=!show;if(show)n++});
    $('#railCount').textContent='Showing '+n+(n===1?' course':' courses'); rail.scrollTo({left:0}); upd();
  }));

  /* Category tabs */
  const tabs=$$('.cat-tab');
  const pick=(t)=>{tabs.forEach(x=>{const on=x===t;x.setAttribute('aria-selected',on);x.tabIndex=on?0:-1;$('#'+x.getAttribute('aria-controls')).hidden=!on});};
  tabs.forEach((t,i)=>{t.addEventListener('click',()=>pick(t));t.addEventListener('keydown',e=>{if(e.key==='ArrowRight'||e.key==='ArrowLeft'){const n=tabs[(i+(e.key==='ArrowRight'?1:-1)+tabs.length)%tabs.length];pick(n);n.focus();e.preventDefault()}})});

  /* Why toggle */
  const data={
    us:[['Learn from real developers','Developers with 5+ years of IT experience teach every class.'],['Practical, hands-on learning','Real projects and case studies in every session.'],['Live project exposure','Every course includes live project assignments.'],['Industry-focused training','A curriculum built around real-world skills.'],['Supportive environment','Small classes, personal attention, a team that backs you.'],['Career-oriented skills','Finish with a certificate and work you can show.']],
    other:[['Teachers who mostly teach','Examples come from the syllabus, not from client work.'],['Theory first, practice later','Long lectures before you write real code.'],['Assignments that end in a folder','Exercises nobody will ever use.'],['Generic curriculum','Topics that lag behind what the industry uses.'],['Crowded batches','Hard to get your questions answered.'],['A certificate and little else','Nothing to show an employer.']]
  };
  const list=$('#whyList'), tog=$('#whyToggle'), knob=$('.knob',tog), btns=$$('button',tog);
  const render=(v)=>{
    list.className='why-list '+(v==='us'?'is-us':'is-other');
    list.innerHTML=data[v].map(([b,s])=>'<li><span class="ic" aria-hidden="true">'+(v==='us'?'✓':'×')+'</span><div><b>'+b+'</b><small>'+s+'</small></div></li>').join('');
    btns.forEach(b=>b.setAttribute('aria-pressed',b.dataset.v===v));
    tog.classList.toggle('on',v==='us');
    const a=btns.find(b=>b.dataset.v===v); knob.style.left=a.offsetLeft+'px'; knob.style.width=a.offsetWidth+'px';
  };
  btns.forEach(b=>b.addEventListener('click',()=>render(b.dataset.v)));
  render('us'); addEventListener('resize',()=>render(tog.classList.contains('on')?'us':'other'));
  document.fonts&&document.fonts.ready.then(()=>render(tog.classList.contains('on')?'us':'other'));

  /* Flip cards (tap/keyboard) */
  $$('.flip').forEach(f=>$('button',f).addEventListener('click',()=>f.classList.toggle('flipped')));

  /* Testimonials */
  const tr=$('#tRail'), dots=$('#tDots'), cards=$$('.tcard',tr);
  cards.forEach((c,i)=>{const b=document.createElement('button');b.type='button';b.setAttribute('aria-label','Show testimonial '+(i+1));b.onclick=()=>tr.scrollTo({left:c.offsetLeft-tr.offsetLeft-4,behavior:reduce?'auto':'smooth'});dots.appendChild(b)});
  const dset=()=>{let best=0,dmin=1e9;cards.forEach((c,i)=>{const d=Math.abs(c.offsetLeft-tr.offsetLeft-4-tr.scrollLeft);if(d<dmin){dmin=d;best=i}});if(tr.scrollLeft+tr.clientWidth>=tr.scrollWidth-4)best=cards.length-1;$$('button',dots).forEach((b,i)=>b.setAttribute('aria-current',i===best))};
  tr.addEventListener('scroll',dset,{passive:true}); dset();
  $('#tPrev').onclick=()=>by(tr,-1); $('#tNext').onclick=()=>by(tr,1);
  let auto=!reduce&&setInterval(()=>{if(document.hidden)return;const end=tr.scrollLeft+tr.clientWidth>=tr.scrollWidth-4;end?tr.scrollTo({left:0,behavior:'smooth'}):by(tr,1)},5000);
  ['pointerdown','focusin','mouseenter'].forEach(ev=>tr.addEventListener(ev,()=>{clearInterval(auto);auto=null}));

  /* FAQ: one open at a time */
  $$('#acc details').forEach(d=>d.addEventListener('toggle',()=>{if(d.open)$$('#acc details').forEach(o=>{if(o!==d)o.open=false})}));
})();
