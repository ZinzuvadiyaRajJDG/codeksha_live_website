<?php @include __DIR__ . '/../inc/tracker.php'; /* analytics */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JavaScript Interview Questions and Answers for Freshers (2026)</title>
    <meta name="description" content="74 JavaScript interview questions and answers with code: basics, closures, async, the event loop, DOM and tricky output questions for freshers." />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <link rel="canonical" href="https://codeksha.com/blog/javascript-interview-questions/" />

    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Codeksha" />
    <meta property="og:title" content="JavaScript Interview Questions and Answers for Freshers (2026)" />
    <meta property="og:description" content="74 JavaScript interview questions and answers with code: basics, closures, async, the event loop, DOM and tricky output questions for freshers." />
    <meta property="og:url" content="https://codeksha.com/blog/javascript-interview-questions/" />
    <meta property="og:image" content="https://codeksha.com/Images/blog/live/javascript-interview-questions.webp" />
    <meta property="og:locale" content="en_IN" />
    <meta property="article:published_time" content="2026-10-29" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="JavaScript Interview Questions and Answers for Freshers (2026)" />
    <meta name="twitter:description" content="74 JavaScript interview questions and answers with code: basics, closures, async, the event loop, DOM and tricky output questions for freshers." />
    <meta name="twitter:image" content="https://codeksha.com/Images/blog/live/javascript-interview-questions.webp" />

    <?php require __DIR__ . '/../inc/partials/head.php'; ?>
    <link rel="stylesheet" href="/assets/blog-extras.css?v=2" />

    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "https://codeksha.com/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Blog",
      "item": "https://codeksha.com/blog/"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "JavaScript Interview Questions",
      "item": "https://codeksha.com/blog/javascript-interview-questions/"
    }
  ]
}
    </script>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "JavaScript Interview Questions and Answers for Freshers (2026)",
  "description": "74 JavaScript interview questions and answers with code: basics, closures, async, the event loop, DOM and tricky output questions for freshers.",
  "image": "https://codeksha.com/Images/blog/live/javascript-interview-questions.webp",
  "datePublished": "2026-10-29",
  "dateModified": "2026-10-29",
  "author": {
    "@type": "Organization",
    "name": "Codeksha",
    "url": "https://codeksha.com/"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Codeksha",
    "logo": {
      "@type": "ImageObject",
      "url": "https://codeksha.com/Images/Codeksha-Logo.png"
    }
  },
  "mainEntityOfPage": "https://codeksha.com/blog/javascript-interview-questions/",
  "inLanguage": "en-IN",
  "keywords": "javascript interview questions, javascript interview questions and answers, javascript interview questions for freshers, javascript coding interview questions"
}
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        { "@type": "Question", "name": "What are the most commonly asked JavaScript interview questions for freshers?", "acceptedAnswer": { "@type": "Answer", "text": "The most common ones are the difference between var, let and const, == vs ===, hoisting, closures, the this keyword, promises and async/await, the event loop and event delegation." } },
        { "@type": "Question", "name": "How many JavaScript questions should I prepare?", "acceptedAnswer": { "@type": "Answer", "text": "You do not need to memorise hundreds. If you can answer the questions in this guide with a short example each, you are ready for most fresher and junior interviews. Depth on closures, async code and the DOM is worth more than breadth." } },
        { "@type": "Question", "name": "Is JavaScript enough to get a developer job?", "acceptedAnswer": { "@type": "Answer", "text": "It is the essential skill, but most employers also expect HTML, CSS, Git and one framework such as React. For full stack roles add Node.js and a database." } },
        { "@type": "Question", "name": "What is the best way to practise JavaScript coding questions?", "acceptedAnswer": { "@type": "Answer", "text": "Write small programs yourself instead of only reading solutions: string manipulation, array methods, a fetch call to a public API and a small DOM project, then explain your code out loud." } },
        { "@type": "Question", "name": "How long does it take to prepare for a JavaScript interview?", "acceptedAnswer": { "@type": "Answer", "text": "If you already know the basics, two to three weeks of daily practice is enough to cover this guide properly. If you are starting from zero, plan two to three months to learn the language first." } }
      ]
    }
    </script>
  </head>
  <body>
    <div class="top-banner">
      <p>Brand new Course Package released! Get 10% off your first purchase with code “CK-10OFF”. <a href="#">Find out more!</a></p>
    </div>

    <?php $ck_active = 'blog'; require __DIR__ . '/../inc/partials/nav.php'; ?>

    <!-- POST HERO -->
    <section class="post-hero">
      <div class="container">
        <p class="breadcrumb"><a href="/">Home</a> / <a href="/blog/">Blog</a> / Web Development</p>
        <span class="post-cat">Web Development</span>
        <h1>JavaScript Interview Questions and Answers for Freshers (2026)</h1>
        <div class="post-meta">
          <span><i class="fa-regular fa-calendar"></i> October 29, 2026</span>
          <span><i class="fa-regular fa-clock"></i> 22 min read</span>
          <span><i class="fa-solid fa-building"></i> Codeksha Team</span>
        </div>
      </div>
    </section>

    <!-- POST BODY -->
    <section class="post-body-section">
      <div class="container">
        <div class="post-layout">
          <div class="post-body">
            <div class="post-feature-img"><img src="/Images/blog/live/javascript-interview-questions.webp" alt="JavaScript interview questions and answers for freshers" width="1200" height="630" fetchpriority="high"></div>

            <details class="post-toc-mobile">
              <summary>In this guide</summary>
              <ul><li><a href="#basics">Core JavaScript basics</a></li><li><a href="#functions">Functions, scope and closures</a></li><li><a href="#objects">Objects, arrays and ES6+</a></li><li><a href="#async">Asynchronous JavaScript</a></li><li><a href="#dom">DOM and browser</a></li><li><a href="#coding">Coding questions</a></li><li><a href="#output">Output-based questions</a></li><li><a href="#how-to-prepare">How to prepare</a></li><li><a href="#faq">FAQs</a></li></ul>
            </details>

<p>If you are applying for a front-end, full stack or Node.js role, JavaScript is the part of the interview you cannot skip. This guide collects <strong>74 JavaScript interview questions and answers</strong> in the order they usually come up: core concepts, functions and closures, objects and ES6, asynchronous code, the DOM, coding exercises and the output-based questions interviewers love. Every answer is short enough to say out loud and comes with code where it helps.</p>
<p>It is written for freshers and students, but the async, event loop and <code>this</code> sections are the same questions asked to developers with 2 to 3 years of experience. Each question is collapsible, so use <strong>Expand all</strong> to read straight through or open them one at a time as a quiz.</p>

<div class="stat-grid">
  <div class="stat-card"><strong>74</strong><span>questions with answers</span></div>
  <div class="stat-card"><strong>7</strong><span>topic groups, basics to async</span></div>
  <div class="stat-card"><strong>2026</strong><span>updated for modern ES2024+ JavaScript</span></div>
</div>

<div class="post-takeaways">
  <p class="post-takeaways-title"><i class="fa-solid fa-bolt"></i> What interviewers actually test</p>
  <ul class="learn-checklist">
    <li><i class="fa-solid fa-circle-check"></i> <span><strong>Fundamentals:</strong> scope, hoisting, <code>this</code>, closures and equality are asked in almost every interview.</span></li>
    <li><i class="fa-solid fa-circle-check"></i> <span><strong>Async:</strong> promises, <code>async/await</code> and the event loop separate beginners from job-ready developers.</span></li>
    <li><i class="fa-solid fa-circle-check"></i> <span><strong>Explaining:</strong> a clear one-line definition plus a small example beats a long answer.</span></li>
  </ul>
</div>

<p>New to the language? Start with our <a href="/blog/javascript-roadmap-for-beginners-what-to-learn-step-by-step/">JavaScript roadmap for beginners</a>, then come back here. If you are aiming for a React job, keep the <a href="/blog/react-js-interview-questions/">React interview questions</a> guide open as well.</p>
<div class="post-lead-inline">
<?php $lf_course = 'Full Stack Web Development'; $lf_id = 'lfjsmid'; $lf_title = 'Want a mock interview and a roadmap?'; $lf_sub = 'Leave your number. A Codeksha counsellor will call you back about syllabus, fees and a free demo class.'; require __DIR__ . '/../inc/partials/lead-form.php'; ?>
</div>
<h2 id="basics" class="qa-group-head">Core JavaScript basics <span class="qa-count">15 questions</span></h2>
<details class="qa" id="q1" open><summary><span class="qa-n">1</span><span class="qa-q">What is JavaScript?</span></summary><div class="qa-a"><p>JavaScript is a high-level, interpreted programming language that runs in every web browser and, through Node.js, on servers too. It is what makes a web page interactive: handling clicks, validating forms, updating content without a reload and talking to servers. It is single-threaded, dynamically typed and supports object-oriented, functional and event-driven styles.</p></div></details>
<details class="qa" id="q2"><summary><span class="qa-n">2</span><span class="qa-q">What is the difference between <code>var</code>, <code>let</code> and <code>const</code>?</span></summary><div class="qa-a"><ul><li><code>var</code> is function-scoped, can be redeclared and is hoisted and initialised as <code>undefined</code>.</li><li><code>let</code> is block-scoped, cannot be redeclared in the same scope and sits in the temporal dead zone until its line runs.</li><li><code>const</code> is block-scoped like <code>let</code> but must be assigned when declared and cannot be reassigned.</li></ul><p><code>const</code> does not make a value immutable: an object or array declared with <code>const</code> can still be changed, only the binding is fixed.</p><pre><code><span class="k">const</span> user = { name: <span class="s">"Asha"</span> };
user.name = <span class="s">"Riya"</span>;   <span class="c">// allowed, the object is mutated</span>
user = {};            <span class="c">// TypeError: Assignment to constant variable</span></code></pre></div></details>
<details class="qa" id="q3"><summary><span class="qa-n">3</span><span class="qa-q">What are the data types in JavaScript?</span></summary><div class="qa-a"><p>There are seven primitive types: <code>string</code>, <code>number</code>, <code>bigint</code>, <code>boolean</code>, <code>undefined</code>, <code>null</code> and <code>symbol</code>. Everything else (objects, arrays, functions, dates) is an <code>object</code>. Primitives are immutable and compared by value; objects are compared by reference.</p></div></details>
<details class="qa" id="q4"><summary><span class="qa-n">4</span><span class="qa-q">What is the difference between <code>==</code> and <code>===</code>?</span></summary><div class="qa-a"><p><code>==</code> compares after type coercion, <code>===</code> compares value and type with no coercion. Prefer <code>===</code> because the coercion rules of <code>==</code> are easy to get wrong.</p><pre><code><span class="n">5</span> == <span class="s">"5"</span>    <span class="c">// true  (string converted to number)</span>
<span class="n">5</span> === <span class="s">"5"</span>   <span class="c">// false (different types)</span>
<span class="k">null</span> == <span class="k">undefined</span>   <span class="c">// true</span>
<span class="k">null</span> === <span class="k">undefined</span>  <span class="c">// false</span></code></pre></div></details>
<details class="qa" id="q5"><summary><span class="qa-n">5</span><span class="qa-q">What is the difference between <code>null</code> and <code>undefined</code>?</span></summary><div class="qa-a"><p><code>undefined</code> means a variable has been declared but not assigned a value (or a function returned nothing). <code>null</code> is an intentional "no value" that a developer assigns. <code>typeof undefined</code> is <code>"undefined"</code>, while <code>typeof null</code> is <code>"object"</code>, a long-standing quirk of the language.</p></div></details>
<details class="qa" id="q6"><summary><span class="qa-n">6</span><span class="qa-q">Why does <code>typeof null</code> return "object"?</span></summary><div class="qa-a"><p>It is a bug from the first version of JavaScript that was never fixed because changing it would break existing websites. <code>null</code> is a primitive, not an object. To check for null, use <code>value === null</code>.</p></div></details>
<details class="qa" id="q7"><summary><span class="qa-n">7</span><span class="qa-q">What is <code>NaN</code> and how do you check for it?</span></summary><div class="qa-a"><p><code>NaN</code> ("Not a Number") is the result of an invalid numeric operation such as <code>0 / "abc"</code>. It is the only value that is not equal to itself, so <code>NaN === NaN</code> is <code>false</code>. Use <code>Number.isNaN(x)</code>, which does not coerce, rather than the global <code>isNaN(x)</code>, which converts the argument to a number first.</p><pre><code>isNaN(<span class="s">"hello"</span>)         <span class="c">// true  (coerces "hello" to NaN)</span>
Number.isNaN(<span class="s">"hello"</span>)   <span class="c">// false (it is a string, not NaN)</span>
Number.isNaN(NaN)       <span class="c">// true</span></code></pre></div></details>
<details class="qa" id="q8"><summary><span class="qa-n">8</span><span class="qa-q">What are truthy and falsy values?</span></summary><div class="qa-a"><p>In a boolean context every value is either truthy or falsy. There are only eight falsy values: <code>false</code>, <code>0</code>, <code>-0</code>, <code>0n</code>, <code>""</code>, <code>null</code>, <code>undefined</code> and <code>NaN</code>. Everything else is truthy, including <code>"0"</code>, <code>[]</code>, <code>{}</code> and <code>"false"</code>.</p></div></details>
<details class="qa" id="q9"><summary><span class="qa-n">9</span><span class="qa-q">What is hoisting?</span></summary><div class="qa-a"><p>Hoisting is JavaScript moving declarations to the top of their scope during the compile phase. Function declarations are hoisted with their body, <code>var</code> is hoisted and set to <code>undefined</code>, and <code>let</code>/<code>const</code> are hoisted but not initialised.</p><pre><code>console.log(a);   <span class="c">// undefined</span>
<span class="k">var</span> a = <span class="n">5</span>;

sayHi();          <span class="c">// works, the whole function is hoisted</span>
<span class="k">function</span> sayHi() { console.log(<span class="s">"hi"</span>); }

console.log(b);   <span class="c">// ReferenceError (temporal dead zone)</span>
<span class="k">let</span> b = <span class="n">5</span>;</code></pre></div></details>
<details class="qa" id="q10"><summary><span class="qa-n">10</span><span class="qa-q">What is the temporal dead zone (TDZ)?</span></summary><div class="qa-a"><p>The TDZ is the time between entering a scope and the line where a <code>let</code> or <code>const</code> variable is declared. Accessing the variable in that window throws a <code>ReferenceError</code>. It exists to catch use-before-define bugs that <code>var</code> silently allowed.</p></div></details>
<details class="qa" id="q11"><summary><span class="qa-n">11</span><span class="qa-q">What are the different types of scope in JavaScript?</span></summary><div class="qa-a"><ul><li><strong>Global scope</strong>: variables declared outside any function or block.</li><li><strong>Function scope</strong>: variables declared inside a function are not visible outside it.</li><li><strong>Block scope</strong>: <code>let</code> and <code>const</code> inside <code>{ }</code> exist only within those braces.</li><li><strong>Module scope</strong>: top-level variables in an ES module are private to that file unless exported.</li></ul><p>Inner scopes can read outer scopes. This lookup is called the scope chain.</p></div></details>
<details class="qa" id="q12"><summary><span class="qa-n">12</span><span class="qa-q">What does "use strict" do?</span></summary><div class="qa-a"><p>Strict mode turns silent mistakes into errors. It prevents accidental global variables, disallows duplicate parameter names, makes <code>this</code> <code>undefined</code> in plain functions and throws when you assign to read-only properties. ES modules and classes are strict by default.</p></div></details>
<details class="qa" id="q13"><summary><span class="qa-n">13</span><span class="qa-q">What is type coercion? Give an example.</span></summary><div class="qa-a"><p>Type coercion is JavaScript converting a value from one type to another automatically. The <code>+</code> operator prefers strings, while <code>-</code>, <code>*</code> and <code>/</code> prefer numbers.</p><pre><code><span class="s">"5"</span> + <span class="n">3</span>     <span class="c">// "53"  (number becomes a string)</span>
<span class="s">"5"</span> - <span class="n">3</span>     <span class="c">// 2     (string becomes a number)</span>
<span class="k">true</span> + <span class="n">1</span>    <span class="c">// 2</span>
[] + {}     <span class="c">// "[object Object]"</span></code></pre></div></details>
<details class="qa" id="q14"><summary><span class="qa-n">14</span><span class="qa-q">What is the difference between <code>let</code> in a loop and <code>var</code> in a loop?</span></summary><div class="qa-a"><p><code>let</code> creates a new binding for every iteration, so closures created in the loop capture the value of that iteration. <code>var</code> has one binding shared by the whole function, so all closures see the final value. This is the classic <code>setTimeout</code> in a <code>for</code> loop question (see the output-based section below).</p></div></details>
<details class="qa" id="q15"><summary><span class="qa-n">15</span><span class="qa-q">What is the difference between a statement and an expression?</span></summary><div class="qa-a"><p>An expression produces a value (<code>2 + 3</code>, <code>fn()</code>, <code>x ? a : b</code>). A statement performs an action (<code>if</code>, <code>for</code>, <code>let x = 1</code>) and does not produce a value you can use inline. Anywhere JavaScript expects a value you must supply an expression.</p></div></details>
<h2 id="functions" class="qa-group-head">Functions, scope and closures <span class="qa-count">13 questions</span></h2>
<p>Closures, <code>this</code> and higher-order functions are where most candidates lose marks, so spend extra time here.</p>
<details class="qa" id="q16"><summary><span class="qa-n">16</span><span class="qa-q">What is the difference between a function declaration and a function expression?</span></summary><div class="qa-a"><p>A declaration (<code>function add() {}</code>) is fully hoisted, so you can call it before it appears in the file. A function expression (<code>const add = function() {}</code>) is only available after the line runs, because the variable is hoisted but not its value.</p></div></details>
<details class="qa" id="q17"><summary><span class="qa-n">17</span><span class="qa-q">How are arrow functions different from regular functions?</span></summary><div class="qa-a"><ul><li>Shorter syntax and an implicit return for single expressions.</li><li>No <code>this</code> of their own: they use the <code>this</code> of the surrounding code (lexical <code>this</code>).</li><li>No <code>arguments</code> object (use rest parameters instead).</li><li>Cannot be used with <code>new</code> as constructors and have no <code>prototype</code>.</li></ul><pre><code><span class="k">const</span> double = n =&gt; n * <span class="n">2</span>;

<span class="k">const</span> counter = {
  count: <span class="n">0</span>,
  start() {
    setInterval(() =&gt; { <span class="k">this</span>.count++; }, <span class="n">1000</span>); <span class="c">// "this" is counter</span>
  }
};</code></pre></div></details>
<details class="qa" id="q18"><summary><span class="qa-n">18</span><span class="qa-q">What is a closure? Give a practical example.</span></summary><div class="qa-a"><p>A closure is a function that remembers the variables of the scope where it was created, even after that outer function has finished running. Closures power private state, memoisation, callbacks and event handlers.</p><pre><code><span class="k">function</span> makeCounter() {
  <span class="k">let</span> count = <span class="n">0</span>;            <span class="c">// private variable</span>
  <span class="k">return</span> <span class="k">function</span> () {
    count++;
    <span class="k">return</span> count;
  };
}
<span class="k">const</span> next = makeCounter();
next(); <span class="c">// 1</span>
next(); <span class="c">// 2  (count survives between calls)</span></code></pre><p class="qa-tip"><strong>Interview tip:</strong> Be ready to name a real use: data hiding, function factories, or why a loop with <code>var</code> and <code>setTimeout</code> misbehaves.</p></div></details>
<details class="qa" id="q19"><summary><span class="qa-n">19</span><span class="qa-q">What is an IIFE and why was it used?</span></summary><div class="qa-a"><p>An Immediately Invoked Function Expression runs as soon as it is defined: <code>(function () { ... })();</code>. Before <code>let</code>, <code>const</code> and modules existed, it was the way to create a private scope and avoid polluting the global namespace.</p></div></details>
<details class="qa" id="q20"><summary><span class="qa-n">20</span><span class="qa-q">What is a higher-order function?</span></summary><div class="qa-a"><p>A function that takes another function as an argument, returns a function, or both. <code>map</code>, <code>filter</code>, <code>reduce</code>, <code>setTimeout</code> and <code>addEventListener</code> are all higher-order functions.</p></div></details>
<details class="qa" id="q21"><summary><span class="qa-n">21</span><span class="qa-q">What is a callback function?</span></summary><div class="qa-a"><p>A function passed into another function to be called later, typically when an operation finishes or an event occurs. Callbacks are the original way to handle asynchronous work in JavaScript, and nesting many of them leads to "callback hell", which promises and <code>async/await</code> solve.</p></div></details>
<details class="qa" id="q22"><summary><span class="qa-n">22</span><span class="qa-q">What is currying?</span></summary><div class="qa-a"><p>Currying turns a function that takes several arguments into a chain of functions that each take one argument.</p><pre><code><span class="k">const</span> add = a =&gt; b =&gt; c =&gt; a + b + c;
add(<span class="n">1</span>)(<span class="n">2</span>)(<span class="n">3</span>); <span class="c">// 6</span>

<span class="k">const</span> addTen = add(<span class="n">5</span>)(<span class="n">5</span>); <span class="c">// partially applied, reusable</span></code></pre></div></details>
<details class="qa" id="q23"><summary><span class="qa-n">23</span><span class="qa-q">Explain <code>call</code>, <code>apply</code> and <code>bind</code>.</span></summary><div class="qa-a"><p>All three set the value of <code>this</code> for a function. <code>call(thisArg, a, b)</code> runs the function immediately with arguments listed out. <code>apply(thisArg, [a, b])</code> runs it immediately with an array of arguments. <code>bind(thisArg)</code> does not run it; it returns a new function with <code>this</code> permanently fixed.</p><pre><code><span class="k">function</span> intro(city) { <span class="k">return</span> <span class="k">this</span>.name + <span class="s">" from "</span> + city; }
<span class="k">const</span> user = { name: <span class="s">"Dev"</span> };
intro.call(user, <span class="s">"Rajkot"</span>);    <span class="c">// "Dev from Rajkot"</span>
intro.apply(user, [<span class="s">"Rajkot"</span>]); <span class="c">// "Dev from Rajkot"</span>
<span class="k">const</span> bound = intro.bind(user);
bound(<span class="s">"Rajkot"</span>);               <span class="c">// "Dev from Rajkot"</span></code></pre></div></details>
<details class="qa" id="q24"><summary><span class="qa-n">24</span><span class="qa-q">How does the <code>this</code> keyword work?</span></summary><div class="qa-a"><ul><li>In a regular function call, <code>this</code> is <code>undefined</code> in strict mode (the global object otherwise).</li><li>As a method (<code>obj.fn()</code>), <code>this</code> is the object before the dot.</li><li>With <code>new</code>, <code>this</code> is the newly created object.</li><li>With <code>call</code>, <code>apply</code> or <code>bind</code>, <code>this</code> is whatever you pass in.</li><li>In an arrow function, <code>this</code> comes from the enclosing scope.</li><li>In a DOM event handler (regular function), <code>this</code> is the element that received the event.</li></ul><p class="qa-tip"><strong>Interview tip:</strong> Interviewers often show a method pulled off an object (<code>const f = obj.method; f()</code>) to see if you know <code>this</code> is lost.</p></div></details>
<details class="qa" id="q25"><summary><span class="qa-n">25</span><span class="qa-q">What is a pure function?</span></summary><div class="qa-a"><p>A pure function always returns the same output for the same input and has no side effects: it does not change external variables, the DOM or files. Pure functions are easier to test and are the basis of how reducers in React/Redux work.</p></div></details>
<details class="qa" id="q26"><summary><span class="qa-n">26</span><span class="qa-q">What is the difference between default, rest and spread parameters?</span></summary><div class="qa-a"><p>Default parameters give a fallback value (<code>function greet(name = "friend")</code>). The rest parameter collects extra arguments into an array (<code>function sum(...nums)</code>). Spread does the opposite and expands an array or object into individual items (<code>Math.max(...nums)</code>).</p></div></details>
<details class="qa" id="q27"><summary><span class="qa-n">27</span><span class="qa-q">What is the difference between debouncing and throttling?</span></summary><div class="qa-a"><p><strong>Debounce</strong> waits until the user has stopped triggering an event for a set time, then runs once (search-as-you-type). <strong>Throttle</strong> runs at most once every set interval no matter how often the event fires (scroll or resize handlers).</p><pre><code><span class="k">function</span> debounce(fn, delay) {
  <span class="k">let</span> timer;
  <span class="k">return</span> <span class="k">function</span> (...args) {
    clearTimeout(timer);
    timer = setTimeout(() =&gt; fn.apply(<span class="k">this</span>, args), delay);
  };
}</code></pre></div></details>
<details class="qa" id="q28"><summary><span class="qa-n">28</span><span class="qa-q">What is recursion? What is its drawback?</span></summary><div class="qa-a"><p>Recursion is a function calling itself until a base case stops it. It suits tree walking and divide-and-conquer problems. Each call adds a frame to the call stack, so very deep recursion throws "Maximum call stack size exceeded"; an iterative loop avoids that.</p><pre><code><span class="k">function</span> factorial(n) {
  <span class="k">if</span> (n &lt;= <span class="n">1</span>) <span class="k">return</span> <span class="n">1</span>;       <span class="c">// base case</span>
  <span class="k">return</span> n * factorial(n - <span class="n">1</span>);
}
factorial(<span class="n">5</span>); <span class="c">// 120</span></code></pre></div></details>
<h2 id="objects" class="qa-group-head">Objects, arrays and ES6+ <span class="qa-count">15 questions</span></h2>
<details class="qa" id="q29"><summary><span class="qa-n">29</span><span class="qa-q">What are the different ways to create an object?</span></summary><div class="qa-a"><ul><li>Object literal: <code>{ name: "Asha" }</code></li><li>Constructor function with <code>new</code></li><li><code>Object.create(proto)</code> to set the prototype directly</li><li>ES6 <code>class</code> with <code>new</code></li><li>Factory function that returns an object</li></ul></div></details>
<details class="qa" id="q30"><summary><span class="qa-n">30</span><span class="qa-q">What is the prototype chain?</span></summary><div class="qa-a"><p>Every object has an internal link to another object called its prototype. When you read a property, JavaScript looks on the object, then its prototype, then that object's prototype, and so on until it reaches <code>null</code>. This chain is how inheritance works, and it is why arrays can use <code>map</code> (it lives on <code>Array.prototype</code>).</p></div></details>
<details class="qa" id="q31"><summary><span class="qa-n">31</span><span class="qa-q">Are JavaScript classes real classes?</span></summary><div class="qa-a"><p>The <code>class</code> keyword is syntax on top of prototypal inheritance. Under the hood a class is still a constructor function and methods live on the prototype. Classes give a cleaner syntax for <code>constructor</code>, <code>extends</code>, <code>super</code>, <code>static</code> and private fields (<code>#field</code>).</p></div></details>
<details class="qa" id="q32"><summary><span class="qa-n">32</span><span class="qa-q">What is the difference between shallow copy and deep copy?</span></summary><div class="qa-a"><p>A shallow copy duplicates only the top level; nested objects are still shared by reference. A deep copy duplicates every level. <code>{ ...obj }</code> and <code>Object.assign</code> are shallow. Use <code>structuredClone(obj)</code> for a deep copy (the older <code>JSON.parse(JSON.stringify(obj))</code> trick loses dates, functions and <code>undefined</code>).</p><pre><code><span class="k">const</span> a = { x: <span class="n">1</span>, nested: { y: <span class="n">2</span> } };
<span class="k">const</span> shallow = { ...a };
shallow.nested.y = <span class="n">99</span>;
console.log(a.nested.y);   <span class="c">// 99  (shared)</span>

<span class="k">const</span> deep = structuredClone(a);
deep.nested.y = <span class="n">5</span>;
console.log(a.nested.y);   <span class="c">// 99  (unchanged)</span></code></pre></div></details>
<details class="qa" id="q33"><summary><span class="qa-n">33</span><span class="qa-q">What is the difference between <code>Object.freeze</code>, <code>Object.seal</code> and <code>const</code>?</span></summary><div class="qa-a"><ul><li><code>const</code> stops reassignment of the variable, but the object can still change.</li><li><code>Object.freeze</code> makes an object read-only: no adding, deleting or changing properties (shallow only).</li><li><code>Object.seal</code> blocks adding and deleting properties but still lets you change existing values.</li></ul></div></details>
<details class="qa" id="q34"><summary><span class="qa-n">34</span><span class="qa-q">What is destructuring?</span></summary><div class="qa-a"><p>Destructuring unpacks values from arrays or properties from objects into variables in one line.</p><pre><code><span class="k">const</span> { name, city = <span class="s">"Rajkot"</span> } = user;     <span class="c">// object</span>
<span class="k">const</span> [first, , third] = [<span class="s">"a"</span>, <span class="s">"b"</span>, <span class="s">"c"</span>];    <span class="c">// array, skipping one</span>
<span class="k">const</span> { address: { pin } } = user;           <span class="c">// nested</span></code></pre></div></details>
<details class="qa" id="q35"><summary><span class="qa-n">35</span><span class="qa-q">What is the difference between the spread and rest operators?</span></summary><div class="qa-a"><p>Both use <code>...</code>. Rest <em>gathers</em> several values into one array or object (in function parameters and destructuring). Spread <em>expands</em> an iterable into separate values (in calls, array literals and object literals).</p><pre><code><span class="k">const</span> nums = [<span class="n">1</span>, <span class="n">2</span>, <span class="n">3</span>];
<span class="k">const</span> more = [...nums, <span class="n">4</span>];            <span class="c">// spread</span>
<span class="k">const</span> { a, ...others } = { a: <span class="n">1</span>, b: <span class="n">2</span>, c: <span class="n">3</span> }; <span class="c">// rest -&gt; others = { b: 2, c: 3 }</span></code></pre></div></details>
<details class="qa" id="q36"><summary><span class="qa-n">36</span><span class="qa-q">What is the difference between <code>map</code>, <code>filter</code>, <code>reduce</code> and <code>forEach</code>?</span></summary><div class="qa-a"><ul><li><code>forEach</code> runs a function for each item and returns nothing.</li><li><code>map</code> returns a new array of the same length with each item transformed.</li><li><code>filter</code> returns a new array with only the items for which the callback returned true.</li><li><code>reduce</code> folds the array down to a single value (a sum, an object, another array).</li></ul><pre><code><span class="k">const</span> prices = [<span class="n">100</span>, <span class="n">250</span>, <span class="n">80</span>];
prices.map(p =&gt; p * <span class="n">1.18</span>);           <span class="c">// [118, 295, 94.4]</span>
prices.filter(p =&gt; p &gt; <span class="n">90</span>);          <span class="c">// [100, 250]</span>
prices.reduce((sum, p) =&gt; sum + p, <span class="n">0</span>); <span class="c">// 430</span></code></pre></div></details>
<details class="qa" id="q37"><summary><span class="qa-n">37</span><span class="qa-q">What is the difference between <code>slice</code> and <code>splice</code>?</span></summary><div class="qa-a"><p><code>slice(start, end)</code> returns a copy of part of an array and does not change the original. <code>splice(start, deleteCount, ...items)</code> removes and/or inserts items in place and mutates the original array. Newer, non-mutating options are <code>toSpliced</code>, <code>toSorted</code> and <code>toReversed</code>.</p></div></details>
<details class="qa" id="q38"><summary><span class="qa-n">38</span><span class="qa-q">How do you remove duplicates from an array?</span></summary><div class="qa-a"><pre><code><span class="k">const</span> unique = [...<span class="k">new</span> Set([<span class="n">1</span>, <span class="n">2</span>, <span class="n">2</span>, <span class="n">3</span>, <span class="n">3</span>])];  <span class="c">// [1, 2, 3]</span></code></pre><p>A <code>Set</code> stores each value only once, and spreading it back gives an array.</p></div></details>
<details class="qa" id="q39"><summary><span class="qa-n">39</span><span class="qa-q">What is the difference between <code>Map</code> and a plain object? And <code>Set</code> vs array?</span></summary><div class="qa-a"><ul><li><code>Map</code> accepts any type as a key (objects, functions), keeps insertion order and has a <code>.size</code>; an object's keys are strings or symbols.</li><li><code>Set</code> stores unique values and has fast <code>.has()</code> lookups; an array allows duplicates and is index-based.</li><li><code>WeakMap</code>/<code>WeakSet</code> hold their keys weakly, so entries can be garbage collected when nothing else references the key.</li></ul></div></details>
<details class="qa" id="q40"><summary><span class="qa-n">40</span><span class="qa-q">What is the difference between <code>for...in</code> and <code>for...of</code>?</span></summary><div class="qa-a"><p><code>for...in</code> loops over the enumerable <em>property names</em> (keys) of an object, including inherited ones. <code>for...of</code> loops over the <em>values</em> of an iterable such as an array, string, Map or Set.</p><pre><code><span class="k">for</span> (<span class="k">const</span> i <span class="k">in</span> [<span class="s">"a"</span>, <span class="s">"b"</span>]) console.log(i);   <span class="c">// "0", "1"</span>
<span class="k">for</span> (<span class="k">const</span> v <span class="k">of</span> [<span class="s">"a"</span>, <span class="s">"b"</span>]) console.log(v);   <span class="c">// "a", "b"</span></code></pre></div></details>
<details class="qa" id="q41"><summary><span class="qa-n">41</span><span class="qa-q">What are optional chaining (<code>?.</code>) and nullish coalescing (<code>??</code>)?</span></summary><div class="qa-a"><p>Optional chaining stops and returns <code>undefined</code> instead of throwing when something in the chain is <code>null</code> or <code>undefined</code>. The <code>??</code> operator returns the right side only when the left is <code>null</code> or <code>undefined</code>, unlike <code>||</code> which also replaces <code>0</code> and <code>""</code>.</p><pre><code>user?.address?.city;      <span class="c">// undefined, no error</span>
<span class="k">const</span> limit = settings.limit ?? <span class="n">10</span>;   <span class="c">// keeps 0 if limit is 0</span></code></pre></div></details>
<details class="qa" id="q42"><summary><span class="qa-n">42</span><span class="qa-q">What are ES modules? How are they different from CommonJS?</span></summary><div class="qa-a"><p>ES modules use <code>import</code>/<code>export</code>, are loaded statically (so tools can tree-shake unused code) and work in browsers and modern Node.js. CommonJS uses <code>require()</code> and <code>module.exports</code>, loads synchronously and was the original Node.js format.</p></div></details>
<details class="qa" id="q43"><summary><span class="qa-n">43</span><span class="qa-q">What do <code>JSON.stringify</code> and <code>JSON.parse</code> do?</span></summary><div class="qa-a"><p><code>JSON.stringify(value)</code> turns a JavaScript value into a JSON string (for sending to a server or saving to storage). <code>JSON.parse(text)</code> turns a JSON string back into a value. Functions, <code>undefined</code> and symbols are dropped by <code>stringify</code>, and dates become strings.</p></div></details>
<h2 id="async" class="qa-group-head">Asynchronous JavaScript <span class="qa-count">10 questions</span></h2>
<p>Expect at least one event loop question in every JavaScript interview.</p>
<details class="qa" id="q44"><summary><span class="qa-n">44</span><span class="qa-q">What is the difference between synchronous and asynchronous code?</span></summary><div class="qa-a"><p>Synchronous code runs line by line and each line waits for the previous one. Asynchronous code starts a long task (a network request, a timer) and lets the rest of the program continue; the result is handled later through a callback, promise or <code>await</code>.</p></div></details>
<details class="qa" id="q45"><summary><span class="qa-n">45</span><span class="qa-q">How does the JavaScript event loop work?</span></summary><div class="qa-a"><p>JavaScript runs on a single thread with a <strong>call stack</strong>. Async work such as timers and network calls is handled by the browser (or Node), which puts the finished callbacks into queues. The event loop repeatedly checks: if the call stack is empty, first run <em>all</em> microtasks (promise callbacks, <code>queueMicrotask</code>), then take one task from the macrotask queue (<code>setTimeout</code>, DOM events), and repeat.</p><p class="qa-tip"><strong>Interview tip:</strong> The sentence "microtasks run before the next macrotask" answers most event loop output questions.</p></div></details>
<details class="qa" id="q46"><summary><span class="qa-n">46</span><span class="qa-q">What is callback hell and how do you avoid it?</span></summary><div class="qa-a"><p>Callback hell is deeply nested callbacks that make code hard to read and handle errors in. You avoid it with promises, <code>async/await</code>, and by splitting logic into small named functions.</p></div></details>
<details class="qa" id="q47"><summary><span class="qa-n">47</span><span class="qa-q">What is a Promise and what are its states?</span></summary><div class="qa-a"><p>A Promise represents a value that will be available later. It is always in one of three states: <strong>pending</strong>, <strong>fulfilled</strong> (resolved with a value) or <strong>rejected</strong> (failed with a reason). Once settled it never changes. You consume it with <code>.then()</code>, <code>.catch()</code> and <code>.finally()</code>.</p><pre><code><span class="k">const</span> wait = ms =&gt; <span class="k">new</span> Promise(resolve =&gt; setTimeout(resolve, ms));
wait(<span class="n">500</span>).then(() =&gt; console.log("done"));</code></pre></div></details>
<details class="qa" id="q48"><summary><span class="qa-n">48</span><span class="qa-q">What is the difference between <code>Promise.all</code>, <code>allSettled</code>, <code>race</code> and <code>any</code>?</span></summary><div class="qa-a"><ul><li><code>Promise.all</code>: waits for all to succeed; rejects as soon as one rejects.</li><li><code>Promise.allSettled</code>: waits for all to finish and returns each result as fulfilled or rejected.</li><li><code>Promise.race</code>: settles as soon as the first promise settles, success or failure.</li><li><code>Promise.any</code>: fulfils with the first success; rejects only if all reject.</li></ul></div></details>
<details class="qa" id="q49"><summary><span class="qa-n">49</span><span class="qa-q">What is <code>async/await</code>?</span></summary><div class="qa-a"><p><code>async/await</code> is syntax that lets you write promise-based code in a synchronous-looking way. An <code>async</code> function always returns a promise, and <code>await</code> pauses that function (not the whole program) until the promise settles.</p><pre><code><span class="k">async</span> <span class="k">function</span> loadUser(id) {
  <span class="k">const</span> res = <span class="k">await</span> fetch(<span class="s">"/api/users/"</span> + id);
  <span class="k">return</span> res.json();
}</code></pre></div></details>
<details class="qa" id="q50"><summary><span class="qa-n">50</span><span class="qa-q">How do you handle errors in async code?</span></summary><div class="qa-a"><p>Wrap <code>await</code> calls in <code>try/catch</code>, or add <code>.catch()</code> to a promise chain. An unhandled rejection can crash a Node process or show up as a console warning in the browser.</p><pre><code><span class="k">try</span> {
  <span class="k">const</span> data = <span class="k">await</span> loadUser(<span class="n">7</span>);
} <span class="k">catch</span> (err) {
  console.error("Could not load user", err);
} <span class="k">finally</span> {
  hideSpinner();
}</code></pre></div></details>
<details class="qa" id="q51"><summary><span class="qa-n">51</span><span class="qa-q">Does <code>fetch</code> reject the promise on a 404 or 500 response?</span></summary><div class="qa-a"><p>No. <code>fetch</code> only rejects on network failure. A 404 or 500 still resolves, so you must check <code>response.ok</code> (or <code>response.status</code>) yourself and throw if needed. This is one of the most common beginner bugs.</p><pre><code><span class="k">const</span> res = <span class="k">await</span> fetch(url);
<span class="k">if</span> (!res.ok) <span class="k">throw</span> <span class="k">new</span> Error(<span class="s">"HTTP "</span> + res.status);
<span class="k">const</span> data = <span class="k">await</span> res.json();</code></pre></div></details>
<details class="qa" id="q52"><summary><span class="qa-n">52</span><span class="qa-q">What is the difference between <code>setTimeout</code> and <code>setInterval</code>?</span></summary><div class="qa-a"><p><code>setTimeout(fn, ms)</code> runs a function once after a delay. <code>setInterval(fn, ms)</code> runs it repeatedly until you call <code>clearInterval</code>. The delay is a minimum, not a guarantee, because the callback must wait for the call stack to be free.</p></div></details>
<details class="qa" id="q53"><summary><span class="qa-n">53</span><span class="qa-q">What are generators and when would you use them?</span></summary><div class="qa-a"><p>A generator (<code>function*</code>) can pause with <code>yield</code> and resume later, producing values one at a time. They are useful for lazy sequences, custom iterators and, historically, the basis on which <code>async/await</code> was built.</p></div></details>
<h2 id="dom" class="qa-group-head">DOM and browser <span class="qa-count">7 questions</span></h2>
<details class="qa" id="q54"><summary><span class="qa-n">54</span><span class="qa-q">What is the DOM?</span></summary><div class="qa-a"><p>The Document Object Model is the browser's tree representation of an HTML page. JavaScript uses it to read, change, add or remove elements and to react to events. It is not part of the JavaScript language itself; it is an API provided by the browser.</p></div></details>
<details class="qa" id="q55"><summary><span class="qa-n">55</span><span class="qa-q">What is the difference between <code>getElementById</code>, <code>querySelector</code> and <code>querySelectorAll</code>?</span></summary><div class="qa-a"><p><code>getElementById</code> finds one element by its id and is the fastest. <code>querySelector</code> accepts any CSS selector and returns the first match. <code>querySelectorAll</code> returns a static <code>NodeList</code> of all matches.</p></div></details>
<details class="qa" id="q56"><summary><span class="qa-n">56</span><span class="qa-q">What are event bubbling and event capturing?</span></summary><div class="qa-a"><p>When an event happens on an element it travels in two phases: <strong>capturing</strong> (from the window down to the target) and then <strong>bubbling</strong> (from the target back up through its parents). Listeners run in the bubbling phase by default. <code>event.stopPropagation()</code> stops the event from travelling further.</p></div></details>
<details class="qa" id="q57"><summary><span class="qa-n">57</span><span class="qa-q">What is event delegation?</span></summary><div class="qa-a"><p>Instead of adding a listener to every child, you add one listener to a common parent and check <code>event.target</code>. It uses less memory and also works for elements added later.</p><pre><code>document.querySelector(<span class="s">"#list"</span>).addEventListener(<span class="s">"click"</span>, (e) =&gt; {
  <span class="k">if</span> (e.target.matches(<span class="s">"li"</span>)) {
    console.log(<span class="s">"clicked"</span>, e.target.textContent);
  }
});</code></pre></div></details>
<details class="qa" id="q58"><summary><span class="qa-n">58</span><span class="qa-q">What is the difference between <code>localStorage</code>, <code>sessionStorage</code> and cookies?</span></summary><div class="qa-a"><ul><li><strong>localStorage</strong>: about 5 MB, stays until cleared, same-origin only, never sent to the server automatically.</li><li><strong>sessionStorage</strong>: same API, but cleared when the tab closes.</li><li><strong>Cookies</strong>: about 4 KB each, can expire, and are sent with every request to that domain, so they suit sessions and authentication.</li></ul><p>Never store passwords or sensitive tokens in <code>localStorage</code>; any script on the page can read it.</p></div></details>
<details class="qa" id="q59"><summary><span class="qa-n">59</span><span class="qa-q">What is the difference between <code>defer</code> and <code>async</code> on a script tag?</span></summary><div class="qa-a"><p>Both download the script without blocking HTML parsing. <code>async</code> runs the script as soon as it is downloaded, in any order. <code>defer</code> waits until the HTML is parsed and runs deferred scripts in the order they appear. Use <code>defer</code> for scripts that depend on the DOM or on each other.</p></div></details>
<details class="qa" id="q60"><summary><span class="qa-n">60</span><span class="qa-q">What is CORS?</span></summary><div class="qa-a"><p>Cross-Origin Resource Sharing is a browser security rule that blocks a page from reading responses from a different origin (protocol, domain or port) unless that server allows it with headers such as <code>Access-Control-Allow-Origin</code>. It is enforced by the browser, so the fix is on the server, not in your front-end code.</p></div></details>
<h2 id="coding" class="qa-group-head">Coding questions <span class="qa-count">7 questions</span></h2>
<p>Short exercises you can write on a whiteboard or in a shared editor in a few minutes.</p>
<details class="qa" id="q61"><summary><span class="qa-n">61</span><span class="qa-q">Reverse a string.</span></summary><div class="qa-a"><pre><code><span class="k">const</span> reverse = (s) =&gt; [...s].reverse().join(<span class="s">""</span>);
reverse(<span class="s">"codeksha"</span>); <span class="c">// "ahskedoc"</span></code></pre></div></details>
<details class="qa" id="q62"><summary><span class="qa-n">62</span><span class="qa-q">Check whether a string is a palindrome.</span></summary><div class="qa-a"><pre><code><span class="k">function</span> isPalindrome(str) {
  <span class="k">const</span> clean = str.toLowerCase().replace(/[^a-z0-<span class="n">9</span>]/g, <span class="s">""</span>);
  <span class="k">return</span> clean === [...clean].reverse().join(<span class="s">""</span>);
}
isPalindrome("A man, a plan, a canal: Panama"); <span class="c">// true</span></code></pre></div></details>
<details class="qa" id="q63"><summary><span class="qa-n">63</span><span class="qa-q">Write FizzBuzz.</span></summary><div class="qa-a"><pre><code><span class="k">for</span> (<span class="k">let</span> i = <span class="n">1</span>; i &lt;= <span class="n">15</span>; i++) {
  <span class="k">if</span> (i % <span class="n">15</span> === <span class="n">0</span>) console.log(<span class="s">"FizzBuzz"</span>);
  <span class="k">else</span> <span class="k">if</span> (i % <span class="n">3</span> === <span class="n">0</span>) console.log(<span class="s">"Fizz"</span>);
  <span class="k">else</span> <span class="k">if</span> (i % <span class="n">5</span> === <span class="n">0</span>) console.log(<span class="s">"Buzz"</span>);
  <span class="k">else</span> console.log(i);
}</code></pre></div></details>
<details class="qa" id="q64"><summary><span class="qa-n">64</span><span class="qa-q">Flatten a nested array.</span></summary><div class="qa-a"><pre><code>[<span class="n">1</span>, [<span class="n">2</span>, [<span class="n">3</span>, [<span class="n">4</span>]]]].flat(Infinity); <span class="c">// [1, 2, 3, 4]</span></code></pre><p>Without <code>flat</code>, use recursion with <code>reduce</code> and <code>concat</code>.</p></div></details>
<details class="qa" id="q65"><summary><span class="qa-n">65</span><span class="qa-q">Count how many times each word appears in a sentence.</span></summary><div class="qa-a"><pre><code><span class="k">const</span> text = "to be or not to be";
<span class="k">const</span> count = text.split(<span class="s">" "</span>).reduce((acc, w) =&gt; {
  acc[w] = (acc[w] || <span class="n">0</span>) + <span class="n">1</span>;
  <span class="k">return</span> acc;
}, {});
<span class="c">// { to: 2, be: 2, or: 1, not: 1 }</span></code></pre></div></details>
<details class="qa" id="q66"><summary><span class="qa-n">66</span><span class="qa-q">Find two numbers in an array that add up to a target (Two Sum).</span></summary><div class="qa-a"><pre><code><span class="k">function</span> twoSum(nums, target) {
  <span class="k">const</span> seen = <span class="k">new</span> Map();            <span class="c">// value -&gt; index</span>
  <span class="k">for</span> (<span class="k">let</span> i = <span class="n">0</span>; i &lt; nums.length; i++) {
    <span class="k">const</span> need = target - nums[i];
    <span class="k">if</span> (seen.has(need)) <span class="k">return</span> [seen.get(need), i];
    seen.set(nums[i], i);
  }
  <span class="k">return</span> [];
}
twoSum([<span class="n">2</span>, <span class="n">7</span>, <span class="n">11</span>, <span class="n">15</span>], <span class="n">9</span>); <span class="c">// [0, 1]</span></code></pre><p>One pass with a Map is O(n) time, compared with O(n²) for two nested loops.</p></div></details>
<details class="qa" id="q67"><summary><span class="qa-n">67</span><span class="qa-q">Implement a simple <code>sleep</code> function with a promise.</span></summary><div class="qa-a"><pre><code><span class="k">const</span> sleep = (ms) =&gt; <span class="k">new</span> Promise((r) =&gt; setTimeout(r, ms));
(<span class="k">async</span> () =&gt; { <span class="k">await</span> sleep(<span class="n">1000</span>); console.log(<span class="s">"1s later"</span>); })();</code></pre></div></details>
<h2 id="output" class="qa-group-head">Output-based questions <span class="qa-count">7 questions</span></h2>
<p>Try to predict the output before you open the answer. This is the fastest way to find the gaps in your understanding.</p>
<details class="qa" id="q68"><summary><span class="qa-n">68</span><span class="qa-q">What is the output? (var in a loop)</span></summary><div class="qa-a"><pre><code><span class="k">for</span> (<span class="k">var</span> i = <span class="n">0</span>; i &lt; <span class="n">3</span>; i++) {
  setTimeout(() =&gt; console.log(i), <span class="n">0</span>);
}</code></pre><p>Output: <code>3 3 3</code>. <code>var</code> has one shared binding and the timeouts run after the loop ends. Change <code>var</code> to <code>let</code> and the output becomes <code>0 1 2</code>.</p></div></details>
<details class="qa" id="q69"><summary><span class="qa-n">69</span><span class="qa-q">What is the output? (microtask vs macrotask)</span></summary><div class="qa-a"><pre><code>console.log(<span class="s">"1"</span>);
setTimeout(() =&gt; console.log(<span class="s">"2"</span>), <span class="n">0</span>);
Promise.resolve().then(() =&gt; console.log(<span class="s">"3"</span>));
console.log(<span class="s">"4"</span>);</code></pre><p>Output: <code>1 4 3 2</code>. Synchronous code first, then the promise (microtask), then the timeout (macrotask).</p></div></details>
<details class="qa" id="q70"><summary><span class="qa-n">70</span><span class="qa-q">What is the output? (floating point)</span></summary><div class="qa-a"><pre><code>console.log(<span class="n">0.1</span> + <span class="n">0.2</span> === <span class="n">0.3</span>);
console.log(<span class="n">0.1</span> + <span class="n">0.2</span>);</code></pre><p>Output: <code>false</code> and <code>0.30000000000000004</code>. Numbers use binary floating point, so some decimals cannot be stored exactly. Compare with a tolerance (<code>Math.abs(a - b) &lt; Number.EPSILON</code>) or work in whole units such as paise.</p></div></details>
<details class="qa" id="q71"><summary><span class="qa-n">71</span><span class="qa-q">What is the output? (coercion)</span></summary><div class="qa-a"><pre><code>console.log([] + []);
console.log([] + {});
console.log(<span class="s">"5"</span> + <span class="n">3</span>, <span class="s">"5"</span> - <span class="n">3</span>);
console.log(<span class="k">typeof</span> NaN);</code></pre><p>Output: an empty string, <code>[object Object]</code>, <code>53 2</code> and <code>number</code>.</p></div></details>
<details class="qa" id="q72"><summary><span class="qa-n">72</span><span class="qa-q">What is the output? (comparison chain)</span></summary><div class="qa-a"><pre><code>console.log(<span class="n">1</span> &lt; <span class="n">2</span> &lt; <span class="n">3</span>);
console.log(<span class="n">3</span> &gt; <span class="n">2</span> &gt; <span class="n">1</span>);</code></pre><p>Output: <code>true</code> and <code>false</code>. <code>3 &gt; 2</code> is <code>true</code>, which becomes <code>1</code>, and <code>1 &gt; 1</code> is <code>false</code>.</p></div></details>
<details class="qa" id="q73"><summary><span class="qa-n">73</span><span class="qa-q">What is the output? (hoisting)</span></summary><div class="qa-a"><pre><code>console.log(<span class="k">typeof</span> hello);
<span class="k">var</span> hello = <span class="s">"hi"</span>;
<span class="k">function</span> hello() {}</code></pre><p>Output: <code>function</code>. The function declaration is hoisted above the <code>var</code>, and the assignment <code>"hi"</code> has not run yet when <code>typeof</code> is evaluated.</p></div></details>
<details class="qa" id="q74"><summary><span class="qa-n">74</span><span class="qa-q">What is the output? (<code>this</code> in an object method)</span></summary><div class="qa-a"><pre><code><span class="k">const</span> user = {
  name: <span class="s">"Asha"</span>,
  regular() { <span class="k">return</span> <span class="k">this</span>.name; },
  arrow: () =&gt; <span class="k">typeof</span> <span class="k">this</span>,
};
<span class="k">const</span> detached = user.regular;
console.log(user.regular(), detached());</code></pre><p><code>user.regular()</code> returns <code>"Asha"</code>. The detached call loses its object, so <code>this.name</code> is <code>undefined</code> (or a TypeError in strict mode). The arrow function does not get its own <code>this</code> either.</p></div></details>
<h2 id="how-to-prepare">How to Prepare for a JavaScript Interview</h2>
<ol class="post-steps">
  <li><strong>Learn the concept, then write it.</strong> After reading each answer, close the page and re-create the example from memory in the browser console.</li>
  <li><strong>Explain out loud.</strong> Practise answering in two or three sentences, the way you would to an interviewer. If you cannot explain it simply, you do not know it yet.</li>
  <li><strong>Build something real.</strong> Interviewers ask about your own projects. A to-do list with a fetch call and local storage covers closures, events, async code and the DOM in one go (see how to <a href="/blog/how-to-build-a-portfolio-that-gets-you-hired-as-a-web-developer/">build a portfolio that gets you hired</a>).</li>
  <li><strong>Practise on a timer.</strong> Pick 5 questions at random, give yourself a minute each and answer without looking.</li>
  <li><strong>Read your own code.</strong> Many questions start with "what is wrong with this snippet?", so get used to spotting <code>this</code> and scope bugs.</li>
  <li><strong>Move on to a framework.</strong> Most job descriptions pair JavaScript with React, Node.js or both. Our <a href="/course/javascript/">JavaScript course</a> and <a href="/course/frontend-development/">Frontend Development course</a> take you from this list to real projects.</li>
</ol>

<div class="post-callout">Want to practise with someone who has interviewed candidates? At Codeksha in Rajkot, our trainers run live classes with real projects and mock interviews as part of the <a href="/course/full-stack-web-development/">Full Stack Web Development course</a>. You can see a class first with a <a href="/book-demo/#course=full-stack-web-development">free demo</a>.</div>

<h2 id="faq">Frequently Asked Questions</h2>
<h3>What are the most commonly asked JavaScript interview questions for freshers?</h3>
<p>The most common ones are the difference between <code>var</code>, <code>let</code> and <code>const</code>, <code>==</code> vs <code>===</code>, hoisting, closures, the <code>this</code> keyword, promises and <code>async/await</code>, the event loop and event delegation. All of them are covered above.</p>
<h3>How many JavaScript questions should I prepare?</h3>
<p>You do not need to memorise hundreds. If you can answer the questions in this guide with a short example each, you are ready for most fresher and junior interviews. Depth on closures, async code and the DOM is worth more than breadth.</p>
<h3>Is JavaScript enough to get a developer job?</h3>
<p>It is the essential skill, but most employers also expect HTML, CSS, Git and one framework such as React. For full stack roles add Node.js and a database. See our <a href="/blog/full-stack-developer-roadmap/">full stack developer roadmap</a> for the complete path.</p>
<h3>What is the best way to practise JavaScript coding questions?</h3>
<p>Write small programs yourself instead of only reading solutions: string manipulation, array methods, a fetch call to a public API, and a small DOM project. Then explain your code out loud as if to an interviewer.</p>
<h3>How long does it take to prepare for a JavaScript interview?</h3>
<p>If you already know the basics, two to three weeks of daily practice (about an hour a day) is enough to cover this guide properly. If you are starting from zero, plan two to three months to learn the language first.</p>

            <div class="post-cta-box">
              <h3>Ready to Go From Answers to Real Projects?</h3>
              <p>Codeksha's <a href="/course/full-stack-web-development/">Full Stack Web Development course</a> in Rajkot teaches JavaScript, React, Node.js and databases with live classes and real projects. Book a free demo class and see a session for yourself.</p>
              <a href="/book-demo/#course=full-stack-web-development" class="hero-enroll-btn">
                <span>Book a Free Demo Class</span>
                <div class="arrow-btn-circle"><i data-lucide="arrow-right"></i></div>
              </a>
            </div>

            <div class="post-lead-inline" id="get-in-touch">
              <?php $lf_course = 'Full Stack Web Development'; $lf_id = 'lfjsend'; $lf_title = 'Get Syllabus, Fees &amp; a Free Demo'; $lf_sub = 'Tell us your number and a Codeksha counsellor will call you back about the Full Stack Web Development course in Rajkot.'; require __DIR__ . '/../inc/partials/lead-form.php'; ?>
            </div>

            <div class="post-tags">
            <span class="post-tag">JavaScript</span>
            <span class="post-tag">Interview Questions</span>
            <span class="post-tag">Freshers</span>
            <span class="post-tag">Web Development</span>
            </div>
            <div class="post-share-row">
              <span>Share:</span>
              <a href="https://www.linkedin.com/company/codeksha/" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="https://x.com/TeamCodeksha" target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter"><i class="fa-brands fa-x-twitter"></i></a>
              <a href="https://www.instagram.com/codeksha_official" target="_blank" rel="noopener noreferrer" aria-label="Share on Instagram"><i class="fa-brands fa-instagram"></i></a>
            </div>
          </div>

          <aside class="post-sidebar has-lead">
            <div class="sidebar-card sidebar-toc">
              <h4><i class="fa-solid fa-list-ul"></i> Table of Contents</h4>
              <ul class="toc-list">
                <li><a href="#basics">Core JavaScript basics</a></li>
                <li><a href="#functions">Functions, scope and closures</a></li>
                <li><a href="#objects">Objects, arrays and ES6+</a></li>
                <li><a href="#async">Asynchronous JavaScript</a></li>
                <li><a href="#dom">DOM and browser</a></li>
                <li><a href="#coding">Coding questions</a></li>
                <li><a href="#output">Output-based questions</a></li>
                <li><a href="#how-to-prepare">How to prepare</a></li>
                <li><a href="#faq">FAQs</a></li>
                </ul>
            </div>
            <div class="sidebar-lead">
              <?php $lf_course = 'Full Stack Web Development'; $lf_id = 'lfjsside'; $lf_title = 'Get a Mock Interview and Free Demo'; $lf_sub = 'Leave your number and our counsellor will call you back. No spam, no pressure.'; require __DIR__ . '/../inc/partials/lead-form.php'; ?>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <!-- RELATED POSTS -->
    <section class="blog-section" style="background:#f8fafc; padding-top:0;">
      <div class="container">
        <div class="section-header">
          <span class="sub-title">KEEP READING</span>
          <h2>Related <span>Articles</span></h2>
        </div>
        <div class="blog-grid">
          <a href="/blog/react-js-interview-questions/" class="blog-card" style="text-decoration:none;">
            <div class="blog-card-img"><img src="/Images/blog/live/react-js-interview-questions.webp" alt="React JS Interview Questions and Answers (2026)" loading="lazy" width="1200" height="630"></div>
            <div class="blog-card-body">
              <span class="blog-card-cat">Web Development</span>
              <h3>React JS Interview Questions and Answers (2026)</h3>
              <p>50 React interview questions with answers: hooks, state, rendering, performance and React 19, for freshers and 1-3 year developers.</p>
              <div class="blog-card-meta"><span>20 min read</span><span>Read more &rarr;</span></div>
            </div>
          </a>
          <a href="/blog/javascript-roadmap-for-beginners-what-to-learn-step-by-step/" class="blog-card" style="text-decoration:none;">
            <div class="blog-card-img"><img src="/Images/blog/live/the-power-of-javascript-why-every-developer-needs-it.webp" alt="JavaScript Roadmap for Beginners: What to Learn Step by Step" loading="lazy" width="1200" height="630"></div>
            <div class="blog-card-body">
              <span class="blog-card-cat">Web Development</span>
              <h3>JavaScript Roadmap for Beginners: What to Learn Step by Step</h3>
              <p>A practical JavaScript roadmap for beginners: what to learn first, in what order, and which mistakes to avoid.</p>
              <div class="blog-card-meta"><span>9 min read</span><span>Read more &rarr;</span></div>
            </div>
          </a>
          <a href="/blog/full-stack-developer-roadmap/" class="blog-card" style="text-decoration:none;">
            <div class="blog-card-img"><img src="/Images/blog/live/full-stack-developer-roadmap.webp" alt="Full Stack Developer Roadmap 2026-27: Skills, Tools, Salary and How to Start" loading="lazy" width="1200" height="630"></div>
            <div class="blog-card-body">
              <span class="blog-card-cat">Career</span>
              <h3>Full Stack Developer Roadmap 2026-27: Skills, Tools, Salary and How to Start</h3>
              <p>A phase-by-phase full stack developer roadmap: what to learn, in what order, how long it takes, the projects to build and what freshers earn.</p>
              <div class="blog-card-meta"><span>15 min read</span><span>Read more &rarr;</span></div>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <?php require __DIR__ . '/../inc/partials/site-footer.php'; ?>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) lucide.createIcons();
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const navLinks = document.getElementById('navLinks');
        const navOverlay = document.getElementById('navOverlay');
        if (hamburgerBtn && navLinks) {
          const toggleMenu = () => {
            const isActive = navLinks.classList.toggle('active');
            if (navOverlay) navOverlay.classList.toggle('active', isActive);
            const icon = hamburgerBtn.querySelector('i');
            if (icon) icon.className = isActive ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
          };
          hamburgerBtn.addEventListener('click', toggleMenu);
          if (navOverlay) navOverlay.addEventListener('click', toggleMenu);
          navLinks.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
            if (navLinks.classList.contains('active')) toggleMenu();
          }));
        }

        // Expand / collapse all questions
        document.querySelectorAll('[data-qa-toggle]').forEach(btn => {
          btn.addEventListener('click', () => {
            const open = btn.getAttribute('data-qa-toggle') === 'open';
            document.querySelectorAll('details.qa').forEach(d => { d.open = open; });
          });
        });
        // Open a question when it is linked to directly (#q12)
        if (location.hash && /^#q\d+$/.test(location.hash)) {
          const t = document.querySelector(location.hash);
          if (t && t.tagName === 'DETAILS') { t.open = true; t.scrollIntoView(); }
        }

        // Table of contents scroll-spy
        const tocLinks = document.querySelectorAll('.toc-list a');
        const tocTargets = Array.from(tocLinks).map(a => document.getElementById(a.getAttribute('href').slice(1))).filter(Boolean);
        if (tocTargets.length && 'IntersectionObserver' in window) {
          const spy = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
              const link = document.querySelector('.toc-list a[href="#' + entry.target.id + '"]');
              if (!link) return;
              if (entry.isIntersecting) {
                tocLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
              }
            });
          }, { rootMargin: '-15% 0px -70% 0px' });
          tocTargets.forEach(t => spy.observe(t));
        }
      });
    </script>
  </body>
</html>
