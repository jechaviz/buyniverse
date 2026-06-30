# Buyniverse

Plataforma moderna y responsiva para **contratación de talento freelance** y **gestión de negocio** (CRM de leads/clientes/proveedores, proyectos, contratos con hitos, productos, gastos y **facturación CFDI 4.0 / SAT**), con asistencia de IA donde aporta valor.

Construida con **React 19 + TypeScript + Vite**, Tailwind (vía CDN), enrutado con React Router (HashRouter) e i18n español/inglés (español por defecto).

## Características

- **Talento y trabajos**: publicación de vacantes, búsqueda de talento, propuestas, concursos en vivo, gigs.
- **Operación**: contratos con hitos y tareas, archivos de proyecto, mensajería, reseñas.
- **CRM**: leads (con embudo de estados), clientes, proveedores.
- **Finanzas (MX)**: facturas CFDI 4.0 con claves SAT, complementos de pago, estimaciones, transacciones, gastos, emisores y folios.
- **Dashboards** configurables con widgets sugeridos por IA.
- **IA (Gemini)**: generación de vacantes, sugerencia de claves SAT (ClaveProdServ/ClaveUnidad/ObjetoImp) y planeación de widgets.
- **Tema** claro/oscuro y **i18n** es/en, ambos persistidos.
- **Persistencia local**: el estado de la app se guarda en `localStorage`, así que sobrevive a recargas.

## Requisitos

- Node.js 18+

## Ejecutar localmente

1. Instala dependencias:
   ```bash
   npm install
   ```
2. Crea tu `.env.local` a partir del ejemplo y coloca tu API key de Gemini:
   ```bash
   cp .env.example .env.local
   # edita .env.local -> GEMINI_API_KEY=tu_clave
   ```
3. Arranca el servidor de desarrollo:
   ```bash
   npm run dev
   ```
   Abre http://localhost:3000

> La app funciona sin `GEMINI_API_KEY`: solo las funciones de IA quedan deshabilitadas (se muestra una advertencia en consola).

## Scripts

- `npm run dev` — servidor de desarrollo Vite (puerto 3000).
- `npm run build` — build de producción a `dist/`.
- `npm run preview` — sirve el build de producción.

## Datos y estado

No hay backend: los datos arrancan desde [`data/mockData.ts`](data/mockData.ts) y todo el estado vive en un único `useReducer` ([`store/reducer.ts`](store/reducer.ts)). El estado se persiste en `localStorage` (clave `buyniverse-state`, versionada); borra esa clave para reiniciar a los datos semilla.

## Nota de seguridad

Esta es una app **100% de cliente**. La `GEMINI_API_KEY` se inyecta en el bundle en tiempo de build, por lo que **queda expuesta a cualquiera que use el sitio publicado**. Para un despliegue real, las llamadas a la IA deben ir detrás de un backend/proxy que custodie la clave; no publiques una clave de producción en el bundle.
