<?php @include __DIR__ . '/../inc/tracker.php'; /* analytics */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>React JS Interview Questions and Answers for Freshers (2026)</title>
    <meta name="description" content="51 React interview questions and answers with code: JSX, hooks, rendering, performance, React 18 and 19 and coding exercises for freshers." />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <link rel="canonical" href="https://codeksha.com/blog/react-js-interview-questions/" />

    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Codeksha" />
    <meta property="og:title" content="React JS Interview Questions and Answers for Freshers (2026)" />
    <meta property="og:description" content="51 React interview questions and answers with code: JSX, hooks, rendering, performance, React 18 and 19 and coding exercises for freshers." />
    <meta property="og:url" content="https://codeksha.com/blog/react-js-interview-questions/" />
    <meta property="og:image" content="https://codeksha.com/Images/blog/live/react-js-interview-questions.webp" />
    <meta property="og:locale" content="en_IN" />
    <meta property="article:published_time" content="2026-10-29" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="React JS Interview Questions and Answers for Freshers (2026)" />
    <meta name="twitter:description" content="51 React interview questions and answers with code: JSX, hooks, rendering, performance, React 18 and 19 and coding exercises for freshers." />
    <meta name="twitter:image" content="https://codeksha.com/Images/blog/live/react-js-interview-questions.webp" />

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
      "name": "React JS Interview Questions",
      "item": "https://codeksha.com/blog/react-js-interview-questions/"
    }
  ]
}
    </script>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "React JS Interview Questions and Answers (2026)",
  "description": "51 React interview questions and answers with code: JSX, hooks, rendering, performance, React 18 and 19 and coding exercises for freshers.",
  "image": "https://codeksha.com/Images/blog/live/react-js-interview-questions.webp",
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
  "mainEntityOfPage": "https://codeksha.com/blog/react-js-interview-questions/",
  "inLanguage": "en-IN",
  "keywords": "react js interview questions, react interview questions, react interview questions for freshers, react hooks interview questions, react interview questions and answers"
}
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        { "@type": "Question", "name": "What are the most asked React interview questions for freshers?", "acceptedAnswer": { "@type": "Answer", "text": "Freshers are usually asked what React is, the virtual DOM, JSX, props vs state, keys in lists, controlled components, useState and useEffect, and how to share state between components." } },
        { "@type": "Question", "name": "Do I need to know class components?", "acceptedAnswer": { "@type": "Answer", "text": "You should recognise them because older codebases use them, and you may be asked about lifecycle methods or error boundaries. For new work, write function components with hooks." } },
        { "@type": "Question", "name": "Is React hard to learn for a beginner?", "acceptedAnswer": { "@type": "Answer", "text": "It is manageable if you already know JavaScript well. Most struggles come from weak JavaScript, not from React itself. Plan about four to six weeks of regular practice to be comfortable with core React." } },
        { "@type": "Question", "name": "Should I learn React or Angular first?", "acceptedAnswer": { "@type": "Answer", "text": "For most beginners, React: it has more job listings and a gentler start, and its ideas transfer to other frameworks. Angular is a full framework that is common in some large enterprises." } },
        { "@type": "Question", "name": "Is Next.js asked in React interviews?", "acceptedAnswer": { "@type": "Answer", "text": "For many product companies and startups, yes. Basic questions on SSR vs CSR, routing and data fetching are common. Learn core React first, then Next.js." } }
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
        <h1>React JS Interview Questions and Answers (2026)</h1>
        <div class="post-meta">
          <span><i class="fa-regular fa-calendar"></i> October 29, 2026</span>
          <span><i class="fa-regular fa-clock"></i> 20 min read</span>
          <span><i class="fa-solid fa-building"></i> Codeksha Team</span>
        </div>
      </div>
    </section>

    <!-- POST BODY -->
    <section class="post-body-section">
      <div class="container">
        <div class="post-layout">
          <div class="post-body">
            <div class="post-feature-img"><img src="/Images/blog/live/react-js-interview-questions.webp" alt="React JS interview questions and answers with hooks and coding examples" width="1200" height="630" fetchpriority="high"></div>

            <details class="post-toc-mobile">
              <summary>In this guide</summary>
              <ul><li><a href="#basics">React basics</a></li><li><a href="#hooks">Hooks</a></li><li><a href="#perf">Rendering and performance</a></li><li><a href="#advanced">Advanced and ecosystem</a></li><li><a href="#coding">Coding questions</a></li><li><a href="#how-to-prepare">How to prepare</a></li><li><a href="#faq">FAQs</a></li></ul>
            </details>

<p>React is the most requested front-end skill in job listings for web developers, so a React round is almost guaranteed if you apply for a front-end or full stack role. This guide has <strong>51 React interview questions and answers</strong>, from "what is JSX?" to hooks, rendering performance, React 18 and React 19 features, plus coding exercises you can type out yourself.</p>
<p>Answers are written to be spoken in under a minute. Use <strong>Expand all</strong> to read everything at once, or open one question at a time as a self-test. Questions that mention a "gotcha" are the ones interviewers use to see whether you have actually built something.</p>

<div class="stat-grid">
  <div class="stat-card"><strong>51</strong><span>questions with answers</span></div>
  <div class="stat-card"><strong>5</strong><span>groups: basics, hooks, performance, advanced, coding</span></div>
  <div class="stat-card"><strong>React 19</strong><span>covers React 18 and 19 changes</span></div>
</div>

<div class="post-takeaways">
  <p class="post-takeaways-title"><i class="fa-solid fa-bolt"></i> Before you start</p>
  <ul class="learn-checklist">
    <li><i class="fa-solid fa-circle-check"></i> <span>React questions assume solid JavaScript. If you are rusty, go through our <a href="/blog/javascript-interview-questions/">JavaScript interview questions</a> first.</span></li>
    <li><i class="fa-solid fa-circle-check"></i> <span>Hooks (<code>useState</code>, <code>useEffect</code>) and how rendering works are asked in nearly every interview.</span></li>
    <li><i class="fa-solid fa-circle-check"></i> <span>Have one project you can walk through: what state it had, where, and why.</span></li>
  </ul>
</div>
<div class="post-lead-inline">
<?php $lf_course = 'Frontend Development'; $lf_id = 'lfreactmid'; $lf_title = 'Learn React the Way Companies Hire For It'; $lf_sub = 'Leave your number and a Codeksha counsellor will call you back about the Frontend Development course and a free demo class.'; require __DIR__ . '/../inc/partials/lead-form.php'; ?>
</div>
<h2 id="basics" class="qa-group-head">React basics <span class="qa-count">12 questions</span></h2>
<details class="qa" id="q1" open><summary><span class="qa-n">1</span><span class="qa-q">What is React and why is it popular?</span></summary><div class="qa-a"><p>React is an open-source JavaScript library from Meta for building user interfaces out of reusable components. It is popular because of its component model, a declarative style (you describe what the UI should look like for a given state and React updates the DOM), a huge ecosystem and strong job demand.</p></div></details>
<details class="qa" id="q2"><summary><span class="qa-n">2</span><span class="qa-q">What is the virtual DOM and how does it work?</span></summary><div class="qa-a"><p>The virtual DOM is a lightweight JavaScript representation of the real DOM. When state changes, React builds a new virtual tree, compares it with the previous one (a process called <strong>reconciliation</strong>) and applies only the differences to the real DOM. Touching the real DOM less is what keeps updates fast.</p></div></details>
<details class="qa" id="q3"><summary><span class="qa-n">3</span><span class="qa-q">What is JSX?</span></summary><div class="qa-a"><p>JSX is a syntax extension that lets you write HTML-like markup inside JavaScript. It is not valid JavaScript by itself; a compiler such as Babel or SWC turns it into function calls. JSX must return a single root element, uses <code>className</code> instead of <code>class</code>, and embeds JavaScript expressions in <code>{ }</code>.</p><pre><code><span class="k">function</span> Welcome({ name }) {
  <span class="k">return</span> &lt;h1 className=<span class="s">"title"</span>&gt;Hello, {name}!&lt;/h1&gt;;
}</code></pre></div></details>
<details class="qa" id="q4"><summary><span class="qa-n">4</span><span class="qa-q">What is the difference between a function component and a class component?</span></summary><div class="qa-a"><p>Function components are plain functions that return JSX and use hooks for state and lifecycle behaviour. Class components extend <code>React.Component</code> and use <code>this.state</code> and lifecycle methods. Function components with hooks are the modern standard; classes still work but are rarely written in new code. The one thing only classes can do is be an error boundary.</p></div></details>
<details class="qa" id="q5"><summary><span class="qa-n">5</span><span class="qa-q">What is the difference between props and state?</span></summary><div class="qa-a"><ul><li><strong>Props</strong> are inputs passed from a parent to a child. They are read-only for the child.</li><li><strong>State</strong> is data a component owns and can change over time. Changing state re-renders the component.</li></ul><p>Data flows one way, down the tree, from parent to child.</p></div></details>
<details class="qa" id="q6"><summary><span class="qa-n">6</span><span class="qa-q">Why do we need <code>key</code> when rendering lists?</span></summary><div class="qa-a"><p>Keys help React identify which items in a list were added, removed or reordered so it can update the DOM efficiently and keep the right component state attached to the right item. Use a stable unique id from your data. Using the array index as a key causes bugs when the list is reordered or filtered.</p><pre><code>{todos.map(todo =&gt; &lt;TodoItem key={todo.id} todo={todo} /&gt;)}</code></pre></div></details>
<details class="qa" id="q7"><summary><span class="qa-n">7</span><span class="qa-q">What are controlled and uncontrolled components?</span></summary><div class="qa-a"><p>In a <strong>controlled</strong> component, React state is the single source of truth for the input value (<code>value</code> plus <code>onChange</code>). In an <strong>uncontrolled</strong> component the DOM holds the value and you read it with a ref when needed. Controlled inputs make validation and instant feedback easy; uncontrolled inputs are simpler for basic forms.</p><pre><code><span class="k">const</span> [email, setEmail] = useState(<span class="s">""</span>);
&lt;input value={email} onChange={e =&gt; setEmail(e.target.value)} /&gt;</code></pre></div></details>
<details class="qa" id="q8"><summary><span class="qa-n">8</span><span class="qa-q">What does "lifting state up" mean?</span></summary><div class="qa-a"><p>When two sibling components need the same data, you move that state to their closest common parent and pass it down as props (with a callback to update it). It keeps one source of truth instead of two copies that can drift apart.</p></div></details>
<details class="qa" id="q9"><summary><span class="qa-n">9</span><span class="qa-q">What is a Fragment and why use it?</span></summary><div class="qa-a"><p>A Fragment (<code>&lt;&gt;...&lt;/&gt;</code> or <code>React.Fragment</code>) lets a component return several elements without adding an extra wrapper <code>div</code> to the DOM. This keeps the HTML cleaner and avoids breaking layouts such as tables and flexbox.</p></div></details>
<details class="qa" id="q10"><summary><span class="qa-n">10</span><span class="qa-q">How do you render something conditionally in React?</span></summary><div class="qa-a"><p>Use a ternary (<code>cond ? &lt;A /&gt; : &lt;B /&gt;</code>), the <code>&amp;&amp;</code> operator for "show or nothing", or an early <code>return</code>. Be careful with <code>&amp;&amp;</code> and numbers: <code>{count &amp;&amp; &lt;List /&gt;}</code> renders a literal <code>0</code> when <code>count</code> is 0, so write <code>{count &gt; 0 &amp;&amp; ...}</code>.</p></div></details>
<details class="qa" id="q11"><summary><span class="qa-n">11</span><span class="qa-q">What is the difference between an element and a component?</span></summary><div class="qa-a"><p>An element is a plain object describing what to show on screen (<code>&lt;div /&gt;</code> or <code>&lt;Button /&gt;</code> creates one). A component is a function (or class) that accepts props and returns elements. Components are the reusable blueprints; elements are what they produce each render.</p></div></details>
<details class="qa" id="q12"><summary><span class="qa-n">12</span><span class="qa-q">What is the <code>children</code> prop?</span></summary><div class="qa-a"><p><code>children</code> is whatever you place between a component's opening and closing tags. It lets you build wrapper components like cards, modals and layouts that do not need to know what goes inside them.</p><pre><code><span class="k">function</span> Card({ children }) {
  <span class="k">return</span> &lt;div className=<span class="s">"card"</span>&gt;{children}&lt;/div&gt;;
}
&lt;Card&gt;&lt;p&gt;Anything goes here&lt;/p&gt;&lt;/Card&gt;</code></pre></div></details>
<h2 id="hooks" class="qa-group-head">Hooks <span class="qa-count">14 questions</span></h2>
<p>Hooks replaced most class-component patterns, so these questions are the core of a modern React interview.</p>
<details class="qa" id="q13"><summary><span class="qa-n">13</span><span class="qa-q">What are React hooks?</span></summary><div class="qa-a"><p>Hooks are functions that let function components use state and other React features. They were added in React 16.8. Examples are <code>useState</code>, <code>useEffect</code>, <code>useContext</code>, <code>useRef</code>, <code>useMemo</code> and <code>useCallback</code>. You can also write your own.</p></div></details>
<details class="qa" id="q14"><summary><span class="qa-n">14</span><span class="qa-q">What are the rules of hooks?</span></summary><div class="qa-a"><ul><li>Call hooks only at the top level of a component or custom hook, never inside loops, conditions or nested functions.</li><li>Call hooks only from React function components or custom hooks, not regular JavaScript functions.</li></ul><p>React tracks hooks by the order they are called, so that order must be the same on every render. The <code>eslint-plugin-react-hooks</code> rule checks this for you.</p></div></details>
<details class="qa" id="q15"><summary><span class="qa-n">15</span><span class="qa-q">How does <code>useState</code> work?</span></summary><div class="qa-a"><p><code>useState(initial)</code> returns the current value and a setter function. Calling the setter schedules a re-render with the new value. When the new state depends on the previous one, pass a function so you never read a stale value.</p><pre><code><span class="k">const</span> [count, setCount] = useState(<span class="n">0</span>);
setCount(prev =&gt; prev + <span class="n">1</span>);   <span class="c">// safe when updates are batched</span></code></pre></div></details>
<details class="qa" id="q16"><summary><span class="qa-n">16</span><span class="qa-q">Why is state update asynchronous, and what is batching?</span></summary><div class="qa-a"><p><code>setState</code> does not change the variable immediately; it queues an update and React re-renders afterwards. Since React 18, updates inside event handlers, timeouts, promises and native events are all <strong>batched</strong> into one render for performance. If you read the state right after calling the setter, you still see the old value.</p></div></details>
<details class="qa" id="q17"><summary><span class="qa-n">17</span><span class="qa-q">How does <code>useEffect</code> work? What is the dependency array?</span></summary><div class="qa-a"><p><code>useEffect</code> runs side effects (fetching data, subscriptions, timers, changing the document title) after the component renders. The dependency array decides when it re-runs:</p><ul><li>No array: after every render.</li><li><code>[]</code>: once, after the first render.</li><li><code>[a, b]</code>: after the first render and whenever <code>a</code> or <code>b</code> changed.</li></ul><pre><code>useEffect(() =&gt; {
  fetch(<span class="s">"/api/courses"</span>).then(r =&gt; r.json()).then(setCourses);
}, []);</code></pre></div></details>
<details class="qa" id="q18"><summary><span class="qa-n">18</span><span class="qa-q">What is the cleanup function in <code>useEffect</code>?</span></summary><div class="qa-a"><p>If the effect returns a function, React runs it before the effect re-runs and when the component unmounts. Use it to remove event listeners, clear timers, close sockets and cancel requests so you do not leak memory or update an unmounted component.</p><pre><code>useEffect(() =&gt; {
  <span class="k">const</span> id = setInterval(tick, <span class="n">1000</span>);
  <span class="k">return</span> () =&gt; clearInterval(id);   <span class="c">// cleanup</span>
}, []);</code></pre></div></details>
<details class="qa" id="q19"><summary><span class="qa-n">19</span><span class="qa-q">What is the difference between <code>useEffect</code> and <code>useLayoutEffect</code>?</span></summary><div class="qa-a"><p><code>useEffect</code> runs after the browser has painted, so it does not block the screen update. <code>useLayoutEffect</code> runs synchronously after DOM changes but before paint, which is useful for measuring layout (element sizes) and avoiding flicker. Use <code>useEffect</code> by default.</p></div></details>
<details class="qa" id="q20"><summary><span class="qa-n">20</span><span class="qa-q">What is <code>useRef</code> and when do you use it?</span></summary><div class="qa-a"><p><code>useRef</code> returns a mutable object (<code>{ current: ... }</code>) that persists across renders and does <strong>not</strong> cause a re-render when changed. Use it to reach a DOM node (focus an input) or to keep a value between renders such as a timer id.</p><pre><code><span class="k">const</span> inputRef = useRef(<span class="k">null</span>);
&lt;input ref={inputRef} /&gt;
&lt;button onClick={() =&gt; inputRef.current.focus()}&gt;Focus&lt;/button&gt;</code></pre></div></details>
<details class="qa" id="q21"><summary><span class="qa-n">21</span><span class="qa-q">What is <code>useMemo</code>?</span></summary><div class="qa-a"><p><code>useMemo(fn, deps)</code> caches the result of an expensive calculation and recomputes it only when its dependencies change. Do not wrap everything in it; measure first, because memoisation itself has a cost.</p><pre><code><span class="k">const</span> visible = useMemo(
  () =&gt; items.filter(i =&gt; i.price &lt; max),
  [items, max]
);</code></pre></div></details>
<details class="qa" id="q22"><summary><span class="qa-n">22</span><span class="qa-q">What is <code>useCallback</code> and how is it different from <code>useMemo</code>?</span></summary><div class="qa-a"><p><code>useCallback(fn, deps)</code> returns the same function instance between renders unless the dependencies change. <code>useMemo</code> caches a <em>value</em>, <code>useCallback</code> caches a <em>function</em> (it is shorthand for <code>useMemo(() =&gt; fn, deps)</code>). It matters mainly when you pass a function to a child wrapped in <code>React.memo</code>.</p></div></details>
<details class="qa" id="q23"><summary><span class="qa-n">23</span><span class="qa-q">What is <code>useContext</code> and the Context API?</span></summary><div class="qa-a"><p>Context lets you share data such as theme, language or the logged-in user with any component in the tree without passing props through every level (prop drilling). You create it with <code>createContext</code>, provide a value with <code>Context.Provider</code> and read it with <code>useContext</code>. All consumers re-render when the value changes.</p></div></details>
<details class="qa" id="q24"><summary><span class="qa-n">24</span><span class="qa-q">When would you use <code>useReducer</code> instead of <code>useState</code>?</span></summary><div class="qa-a"><p>When state has several related values or complex update logic, such as a form or a shopping cart. A reducer function takes the current state and an action and returns the next state, which makes transitions predictable and easy to test.</p><pre><code><span class="k">function</span> reducer(state, action) {
  <span class="k">switch</span> (action.type) {
    <span class="k">case</span> <span class="s">"add"</span>: <span class="k">return</span> [...state, action.item];
    <span class="k">case</span> <span class="s">"remove"</span>: <span class="k">return</span> state.filter(i =&gt; i.id !== action.id);
    <span class="k">default</span>: <span class="k">return</span> state;
  }
}
<span class="k">const</span> [cart, dispatch] = useReducer(reducer, []);</code></pre></div></details>
<details class="qa" id="q25"><summary><span class="qa-n">25</span><span class="qa-q">What is a custom hook?</span></summary><div class="qa-a"><p>A custom hook is a function whose name starts with <code>use</code> and that calls other hooks to package reusable stateful logic, for example <code>useFetch</code>, <code>useLocalStorage</code> or <code>useDebounce</code>. Each component that calls it gets its own separate state.</p><pre><code><span class="k">function</span> useLocalStorage(key, initial) {
  <span class="k">const</span> [value, setValue] = useState(
    () =&gt; JSON.parse(localStorage.getItem(key)) ?? initial
  );
  useEffect(() =&gt; {
    localStorage.setItem(key, JSON.stringify(value));
  }, [key, value]);
  <span class="k">return</span> [value, setValue];
}</code></pre></div></details>
<details class="qa" id="q26"><summary><span class="qa-n">26</span><span class="qa-q">What is a stale closure in hooks?</span></summary><div class="qa-a"><p>If an effect or callback captures a variable from one render and its dependency array does not list it, the function keeps seeing the old value. For example an interval that reads <code>count</code> but has <code>[]</code> as dependencies always logs the first value. Fix it by adding the dependency, using the functional form of the setter (<code>setCount(c =&gt; c + 1)</code>) or a ref.</p><p class="qa-tip"><strong>Interview tip:</strong> Mentioning stale closures shows you understand hooks beyond the syntax.</p></div></details>
<h2 id="perf" class="qa-group-head">Rendering and performance <span class="qa-count">6 questions</span></h2>
<details class="qa" id="q27"><summary><span class="qa-n">27</span><span class="qa-q">What is reconciliation and how does React's diffing work?</span></summary><div class="qa-a"><p>Reconciliation is how React decides what to change in the DOM. It compares the old and new element trees with two assumptions: elements of different types produce different trees (so the whole subtree is rebuilt), and keys identify stable children in a list. This gives a fast O(n) comparison instead of a full tree diff.</p></div></details>
<details class="qa" id="q28"><summary><span class="qa-n">28</span><span class="qa-q">Why does a component re-render?</span></summary><div class="qa-a"><ul><li>Its own state changed.</li><li>Its parent re-rendered (even if the props are the same).</li><li>A context it consumes changed.</li></ul><p>Re-rendering is cheap on its own; it only becomes a problem when it is slow or triggered too often. Props changing is not a separate trigger: a child re-renders because its parent did.</p></div></details>
<details class="qa" id="q29"><summary><span class="qa-n">29</span><span class="qa-q">What does <code>React.memo</code> do?</span></summary><div class="qa-a"><p><code>React.memo(Component)</code> skips re-rendering a component when its props are shallowly equal to the previous props. It works best together with <code>useCallback</code> and <code>useMemo</code> so that object and function props keep the same identity between renders.</p></div></details>
<details class="qa" id="q30"><summary><span class="qa-n">30</span><span class="qa-q">What is code splitting, <code>React.lazy</code> and <code>Suspense</code>?</span></summary><div class="qa-a"><p>Code splitting breaks your bundle into smaller chunks that load on demand. <code>React.lazy</code> loads a component only when it is first rendered, and <code>Suspense</code> shows a fallback (such as a spinner) while it loads.</p><pre><code><span class="k">const</span> Dashboard = React.lazy(() =&gt; <span class="k">import</span>(<span class="s">"./Dashboard"</span>));

&lt;Suspense fallback={&lt;p&gt;Loading...&lt;/p&gt;}&gt;
  &lt;Dashboard /&gt;
&lt;/Suspense&gt;</code></pre></div></details>
<details class="qa" id="q31"><summary><span class="qa-n">31</span><span class="qa-q">How do you optimise a slow React app?</span></summary><div class="qa-a"><ul><li>Measure first with the React DevTools Profiler.</li><li>Avoid unnecessary re-renders with <code>React.memo</code>, <code>useMemo</code> and <code>useCallback</code> where it measurably helps.</li><li>Keep state as close as possible to where it is used.</li><li>Virtualise long lists (react-window or similar).</li><li>Split code with <code>React.lazy</code> and optimise images.</li><li>Use stable keys and avoid creating components inside components.</li></ul></div></details>
<details class="qa" id="q32"><summary><span class="qa-n">32</span><span class="qa-q">What is the difference between client-side rendering and server-side rendering?</span></summary><div class="qa-a"><p>With <strong>client-side rendering (CSR)</strong> the browser downloads JavaScript and builds the page on the device, which can be slow to show content and weak for SEO. With <strong>server-side rendering (SSR)</strong> the server sends ready HTML first and React then "hydrates" it to make it interactive, giving faster first paint and better SEO. Frameworks such as Next.js handle SSR and static generation.</p></div></details>
<h2 id="advanced" class="qa-group-head">Advanced and ecosystem <span class="qa-count">14 questions</span></h2>
<p>Expect these in interviews for candidates with some experience or an internship.</p>
<details class="qa" id="q33"><summary><span class="qa-n">33</span><span class="qa-q">What is prop drilling and how do you avoid it?</span></summary><div class="qa-a"><p>Prop drilling is passing props through many layers of components that do not use them, just to reach a deeply nested child. Avoid it with the Context API, component composition (passing JSX as <code>children</code>) or a state library such as Redux Toolkit or Zustand.</p></div></details>
<details class="qa" id="q34"><summary><span class="qa-n">34</span><span class="qa-q">When would you use Redux instead of Context?</span></summary><div class="qa-a"><p>Context is good for low-frequency, app-wide values like theme or user. Redux (with Redux Toolkit) is better for large apps with complex shared state, frequent updates, middleware (async logic) and great debugging tools, because it lets components subscribe to only the slices they need. For many projects, local state plus Context or a small library like Zustand is enough.</p></div></details>
<details class="qa" id="q35"><summary><span class="qa-n">35</span><span class="qa-q">What is a higher-order component (HOC)?</span></summary><div class="qa-a"><p>A function that takes a component and returns a new component with extra behaviour, such as <code>withAuth(Dashboard)</code>. HOCs were a common reuse pattern before hooks; custom hooks now cover most of those cases more simply.</p></div></details>
<details class="qa" id="q36"><summary><span class="qa-n">36</span><span class="qa-q">What are error boundaries?</span></summary><div class="qa-a"><p>An error boundary is a class component that catches JavaScript errors in its child tree during rendering and shows a fallback UI instead of crashing the whole app. They are written with <code>componentDidCatch</code> or <code>static getDerivedStateFromError</code>, or you can use the <code>react-error-boundary</code> library. They do not catch errors in event handlers or async code.</p></div></details>
<details class="qa" id="q37"><summary><span class="qa-n">37</span><span class="qa-q">What are portals?</span></summary><div class="qa-a"><p><code>ReactDOM.createPortal(children, domNode)</code> renders children into a different DOM node outside the parent hierarchy, while keeping them in the same React tree. It is used for modals, tooltips and dropdowns that must escape <code>overflow: hidden</code> or z-index issues.</p></div></details>
<details class="qa" id="q38"><summary><span class="qa-n">38</span><span class="qa-q">What is <code>StrictMode</code>?</span></summary><div class="qa-a"><p><code>&lt;React.StrictMode&gt;</code> is a development-only wrapper that highlights problems: it double-invokes render functions and effects to surface impure code and missing cleanups. It has no effect on the production build. If your <code>useEffect</code> seems to run twice in development, this is why.</p></div></details>
<details class="qa" id="q39"><summary><span class="qa-n">39</span><span class="qa-q">What changed in React 18?</span></summary><div class="qa-a"><ul><li><strong>Concurrent rendering</strong> so React can interrupt and prioritise updates.</li><li><strong>Automatic batching</strong> of updates everywhere, not just in event handlers.</li><li><code>createRoot</code> as the new root API.</li><li><code>useTransition</code> and <code>useDeferredValue</code> to keep the UI responsive during heavy updates.</li><li>Streaming server rendering with <code>Suspense</code>.</li></ul></div></details>
<details class="qa" id="q40"><summary><span class="qa-n">40</span><span class="qa-q">What is new in React 19?</span></summary><div class="qa-a"><ul><li><strong>Actions</strong> and the <code>useActionState</code> hook to handle form submissions and pending/error state.</li><li><code>useOptimistic</code> for instant, optimistic UI updates.</li><li>The <code>use</code> API to read a promise or context during render.</li><li><code>ref</code> can be passed as a normal prop in function components, so <code>forwardRef</code> is rarely needed.</li><li>Native support for document metadata (<code>&lt;title&gt;</code>, <code>&lt;meta&gt;</code>) and stable <strong>Server Components</strong> support in frameworks.</li></ul><p>Check the official React blog for the current version before an interview, because details keep evolving.</p></div></details>
<details class="qa" id="q41"><summary><span class="qa-n">41</span><span class="qa-q">What are React Server Components?</span></summary><div class="qa-a"><p>Server Components render on the server and send only the result to the browser, so their code and heavy dependencies never ship in the client bundle. They can read databases or files directly. Interactive parts are Client Components marked with <code>"use client"</code>. They are used mainly through frameworks such as Next.js.</p></div></details>
<details class="qa" id="q42"><summary><span class="qa-n">42</span><span class="qa-q">What are synthetic events in React?</span></summary><div class="qa-a"><p>React wraps native browser events in a cross-browser object called a SyntheticEvent so that <code>onClick</code>, <code>onChange</code> and others behave the same everywhere. Handlers receive this object, and you can call <code>e.preventDefault()</code> and <code>e.stopPropagation()</code> on it.</p></div></details>
<details class="qa" id="q43"><summary><span class="qa-n">43</span><span class="qa-q">How do you handle forms and validation in React?</span></summary><div class="qa-a"><p>For simple forms use controlled inputs with <code>useState</code>. For bigger forms use a library such as React Hook Form (less re-rendering) together with a schema validator like Zod or Yup. Always validate on the server as well; client-side checks are for user experience, not security.</p></div></details>
<details class="qa" id="q44"><summary><span class="qa-n">44</span><span class="qa-q">How do you fetch data in a React component?</span></summary><div class="qa-a"><p>The basic pattern is <code>fetch</code> or Axios inside <code>useEffect</code> with loading and error state, plus a cleanup to ignore results from outdated requests. In real projects, a data library such as TanStack Query (React Query) or SWR handles caching, retries and refetching for you.</p><pre><code>useEffect(() =&gt; {
  <span class="k">let</span> ignore = <span class="k">false</span>;
  fetch(<span class="s">"/api/courses"</span>)
    .then(r =&gt; r.json())
    .then(data =&gt; { <span class="k">if</span> (!ignore) setCourses(data); });
  <span class="k">return</span> () =&gt; { ignore = <span class="k">true</span>; };
}, []);</code></pre></div></details>
<details class="qa" id="q45"><summary><span class="qa-n">45</span><span class="qa-q">How does routing work in React?</span></summary><div class="qa-a"><p>React itself has no router. React Router (or the file-based routers in Next.js) maps URLs to components without a full page reload. Key pieces are <code>BrowserRouter</code>, <code>Routes</code>/<code>Route</code>, <code>Link</code>/<code>NavLink</code> for navigation, and hooks like <code>useParams</code> and <code>useNavigate</code>.</p></div></details>
<details class="qa" id="q46"><summary><span class="qa-n">46</span><span class="qa-q">How do you test React components?</span></summary><div class="qa-a"><p>Use Jest or Vitest as the test runner and React Testing Library to render components and interact with them the way a user does (find by text or role, click, type) rather than testing implementation details. Use Playwright or Cypress for end-to-end tests.</p></div></details>
<h2 id="coding" class="qa-group-head">Coding questions <span class="qa-count">5 questions</span></h2>
<p>Small components that interviewers ask you to build live. Practise writing them from memory.</p>
<details class="qa" id="q47"><summary><span class="qa-n">47</span><span class="qa-q">Build a counter component with increment, decrement and reset.</span></summary><div class="qa-a"><pre><code><span class="k">function</span> Counter() {
  <span class="k">const</span> [count, setCount] = useState(<span class="n">0</span>);
  <span class="k">return</span> (
    &lt;div&gt;
      &lt;p&gt;{count}&lt;/p&gt;
      &lt;button onClick={() =&gt; setCount(c =&gt; c - <span class="n">1</span>)}&gt;-&lt;/button&gt;
      &lt;button onClick={() =&gt; setCount(c =&gt; c + <span class="n">1</span>)}&gt;+&lt;/button&gt;
      &lt;button onClick={() =&gt; setCount(<span class="n">0</span>)}&gt;Reset&lt;/button&gt;
    &lt;/div&gt;
  );
}</code></pre></div></details>
<details class="qa" id="q48"><summary><span class="qa-n">48</span><span class="qa-q">Build a search filter for a list.</span></summary><div class="qa-a"><pre><code><span class="k">function</span> CourseList({ courses }) {
  <span class="k">const</span> [query, setQuery] = useState(<span class="s">""</span>);
  <span class="k">const</span> shown = courses.filter(c =&gt;
    c.title.toLowerCase().includes(query.toLowerCase())
  );
  <span class="k">return</span> (
    &lt;&gt;
      &lt;input value={query} onChange={e =&gt; setQuery(e.target.value)} placeholder=<span class="s">"Search"</span> /&gt;
      &lt;ul&gt;{shown.map(c =&gt; &lt;li key={c.id}&gt;{c.title}&lt;/li&gt;)}&lt;/ul&gt;
    &lt;/&gt;
  );
}</code></pre></div></details>
<details class="qa" id="q49"><summary><span class="qa-n">49</span><span class="qa-q">Write a <code>useDebounce</code> hook.</span></summary><div class="qa-a"><pre><code><span class="k">function</span> useDebounce(value, delay = <span class="n">400</span>) {
  <span class="k">const</span> [debounced, setDebounced] = useState(value);
  useEffect(() =&gt; {
    <span class="k">const</span> id = setTimeout(() =&gt; setDebounced(value), delay);
    <span class="k">return</span> () =&gt; clearTimeout(id);
  }, [value, delay]);
  <span class="k">return</span> debounced;
}</code></pre></div></details>
<details class="qa" id="q50"><summary><span class="qa-n">50</span><span class="qa-q">Fetch and display users with loading and error states.</span></summary><div class="qa-a"><pre><code><span class="k">function</span> Users() {
  <span class="k">const</span> [users, setUsers] = useState([]);
  <span class="k">const</span> [loading, setLoading] = useState(<span class="k">true</span>);
  <span class="k">const</span> [error, setError] = useState(<span class="k">null</span>);

  useEffect(() =&gt; {
    fetch("https:<span class="c">//jsonplaceholder.typicode.com/users")</span>
      .then(r =&gt; { <span class="k">if</span> (!r.ok) <span class="k">throw</span> <span class="k">new</span> Error(<span class="s">"Request failed"</span>); <span class="k">return</span> r.json(); })
      .then(setUsers)
      .<span class="k">catch</span>(setError)
      .<span class="k">finally</span>(() =&gt; setLoading(<span class="k">false</span>));
  }, []);

  <span class="k">if</span> (loading) <span class="k">return</span> &lt;p&gt;Loading...&lt;/p&gt;;
  <span class="k">if</span> (error) <span class="k">return</span> &lt;p&gt;Something went wrong&lt;/p&gt;;
  <span class="k">return</span> &lt;ul&gt;{users.map(u =&gt; &lt;li key={u.id}&gt;{u.name}&lt;/li&gt;)}&lt;/ul&gt;;
}</code></pre></div></details>
<details class="qa" id="q51"><summary><span class="qa-n">51</span><span class="qa-q">Build a toggle (show/hide) component.</span></summary><div class="qa-a"><pre><code><span class="k">function</span> Toggle() {
  <span class="k">const</span> [open, setOpen] = useState(<span class="k">false</span>);
  <span class="k">return</span> (
    &lt;&gt;
      &lt;button onClick={() =&gt; setOpen(o =&gt; !o)}&gt;{open ? <span class="s">"Hide"</span> : <span class="s">"Show"</span>} details&lt;/button&gt;
      {open &amp;&amp; &lt;p&gt;Here are the details.&lt;/p&gt;}
    &lt;/&gt;
  );
}</code></pre></div></details>
<h2 id="how-to-prepare">How to Prepare for a React Interview</h2>
<ol class="post-steps">
  <li><strong>Build two or three real apps.</strong> A to-do list with filters, a weather or news app that calls an API, and a small dashboard cover state, effects, lists, forms and routing.</li>
  <li><strong>Learn why, not only how.</strong> Be ready to explain why a component re-rendered or why an effect ran twice. React DevTools Profiler helps you see it.</li>
  <li><strong>Practise the coding questions above</strong> without looking, then compare. Interviewers care about clean state handling more than clever code.</li>
  <li><strong>Know one state tool and one data-fetching approach.</strong> For example Context or Zustand, plus TanStack Query or plain <code>useEffect</code> with loading and error states.</li>
  <li><strong>Read the official docs.</strong> The <a href="https://react.dev/learn" target="_blank" rel="noopener">react.dev learn section</a> is the best free resource and is what many interviewers themselves rely on.</li>
  <li><strong>Learn the stack around it.</strong> Git, a CSS approach, REST APIs and, for full stack roles, Node.js and a database. The <a href="/blog/full-stack-developer-roadmap/">full stack developer roadmap</a> shows the order.</li>
</ol>

<div class="post-callout">Learning React in Rajkot? Codeksha's <a href="/course/frontend-development/">Frontend Development course</a> covers HTML, CSS, JavaScript and React with live classes and projects, and the <a href="/course/full-stack-web-development/">Full Stack Web Development course</a> adds Node.js and databases. See a class first with a <a href="/book-demo/#course=frontend-development">free demo</a>.</div>

<h2 id="faq">Frequently Asked Questions</h2>
<h3>What are the most asked React interview questions for freshers?</h3>
<p>Freshers are usually asked: what is React, the virtual DOM, JSX, props vs state, keys in lists, controlled components, <code>useState</code> and <code>useEffect</code>, and how to share state between components. All of these are covered above.</p>
<h3>Do I need to know class components?</h3>
<p>You should recognise them because older codebases use them, and you may be asked about lifecycle methods or error boundaries. For new work, write function components with hooks.</p>
<h3>Is React hard to learn for a beginner?</h3>
<p>It is manageable if you already know JavaScript well: functions, arrays, objects, destructuring and async code. Most struggles come from weak JavaScript, not from React itself. Plan about four to six weeks of regular practice to be comfortable with core React.</p>
<h3>Should I learn React or Angular first?</h3>
<p>For most beginners, React: it has more job listings and a gentler start, and its ideas transfer to other frameworks. Angular is a full framework that is common in some large enterprises. Choose based on the jobs near you.</p>
<h3>Is Next.js asked in React interviews?</h3>
<p>For many product companies and startups, yes. Basic questions on SSR vs CSR, routing and data fetching are common. Learn core React first, then Next.js.</p>

            <div class="post-cta-box">
              <h3>Want to Build React Projects With a Mentor?</h3>
              <p>Codeksha's <a href="/course/frontend-development/">Frontend Development course</a> in Rajkot teaches HTML, CSS, JavaScript and React through live classes and real projects. Book a free demo class and see a session for yourself.</p>
              <a href="/book-demo/#course=frontend-development" class="hero-enroll-btn">
                <span>Book a Free Demo Class</span>
                <div class="arrow-btn-circle"><i data-lucide="arrow-right"></i></div>
              </a>
            </div>

            <div class="post-lead-inline" id="get-in-touch">
              <?php $lf_course = 'Frontend Development'; $lf_id = 'lfreactend'; $lf_title = 'Get Syllabus, Fees &amp; a Free Demo'; $lf_sub = 'Tell us your number and a Codeksha counsellor will call you back about the Frontend Development course in Rajkot.'; require __DIR__ . '/../inc/partials/lead-form.php'; ?>
            </div>

            <div class="post-tags">
            <span class="post-tag">React</span>
            <span class="post-tag">Interview Questions</span>
            <span class="post-tag">Hooks</span>
            <span class="post-tag">Frontend</span>
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
                <li><a href="#basics">React basics</a></li>
                <li><a href="#hooks">Hooks</a></li>
                <li><a href="#perf">Rendering and performance</a></li>
                <li><a href="#advanced">Advanced and ecosystem</a></li>
                <li><a href="#coding">Coding questions</a></li>
                <li><a href="#how-to-prepare">How to prepare</a></li>
                <li><a href="#faq">FAQs</a></li>
                </ul>
            </div>
            <div class="sidebar-lead">
              <?php $lf_course = 'Frontend Development'; $lf_id = 'lfreactside'; $lf_title = 'Learn React With Real Projects'; $lf_sub = 'Leave your number and our counsellor will call you back. No spam, no pressure.'; require __DIR__ . '/../inc/partials/lead-form.php'; ?>
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
          <a href="/blog/javascript-interview-questions/" class="blog-card" style="text-decoration:none;">
            <div class="blog-card-img"><img src="/Images/blog/live/javascript-interview-questions.webp" alt="JavaScript Interview Questions and Answers for Freshers (2026)" loading="lazy" width="1200" height="630"></div>
            <div class="blog-card-body">
              <span class="blog-card-cat">Web Development</span>
              <h3>JavaScript Interview Questions and Answers for Freshers (2026)</h3>
              <p>60+ JavaScript interview questions with clear answers and code: basics, closures, async, DOM and tricky output questions for freshers.</p>
              <div class="blog-card-meta"><span>22 min read</span><span>Read more &rarr;</span></div>
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
          <a href="/blog/the-top-5-web-development-frameworks-you-should-learn-in-2025/" class="blog-card" style="text-decoration:none;">
            <div class="blog-card-img"><img src="/Images/blog/live/the-top-5-web-development-frameworks-you-should-learn-in-2025.webp" alt="The Top 5 Web Development Frameworks You Should Learn" loading="lazy" width="1200" height="630"></div>
            <div class="blog-card-body">
              <span class="blog-card-cat">Web Development</span>
              <h3>The Top 5 Web Development Frameworks You Should Learn</h3>
              <p>A practical overview of five web development frameworks worth learning.</p>
              <div class="blog-card-meta"><span>7 min read</span><span>Read more &rarr;</span></div>
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
