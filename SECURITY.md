# Modelo de seguridad — Buyniverse

Este documento describe el modelo de seguridad de Buyniverse, sus límites inherentes
y los controles aplicados. **Buyniverse es una aplicación de demostración 100% de
cliente, sin backend ni servidor de aplicación.** Esto condiciona por completo qué
garantías de seguridad puede y no puede ofrecer.

## Naturaleza de la app

- **Sin backend.** Toda la lógica corre en el navegador. No hay servidor que valide
  peticiones, autorice acciones ni custodie secretos.
- **Sin autenticación real.** No existe inicio de sesión, contraseñas ni sesiones.
  El "usuario actual" se elige en el cliente mediante la acción `SWITCH_TO_USER`
  del store, que simplemente cambia qué identidad ve la interfaz. No hay credenciales
  que verificar ni control del lado del servidor: cualquiera que abra la app puede
  asumir cualquier identidad.
- **Persistencia local.** El estado vive en `localStorage` (clave `buyniverse-state`).
  No se transmite ni se comparte; es privado de ese navegador, pero también totalmente
  manipulable por quien controle el dispositivo.

## Riesgos OWASP inherentes al diseño sin backend

Los siguientes riesgos del OWASP Top 10 **no son defectos corregibles dentro de esta
arquitectura**: son consecuencia directa de no tener backend. Documentarlos es parte
del modelo de seguridad, no una promesa de mitigarlos en el cliente.

### A01:2021 — Broken Access Control

No hay control de acceso porque no hay un servidor que lo imponga. El cambio de
identidad (`SWITCH_TO_USER`) ocurre íntegramente en el cliente y no está protegido por
ninguna autorización. En una app de cliente puro, **todo control de acceso es eludible**
editando el estado en memoria o en `localStorage`. La única mitigación real requiere un
backend que autentique y autorice cada operación.

### A07:2021 — Identification and Authentication Failures

No existe autenticación: no hay contraseñas, tokens de sesión, MFA ni gestión de
sesiones. El concepto de "usuario" es puramente de presentación. Esto es intencional
para una demo, pero significa que **no se puede confiar en la identidad** que muestra la
app. La mitigación real requiere un proveedor de identidad y validación server-side.

## Exposición de `GEMINI_API_KEY`

Las funciones de IA usan la API de Gemini. La clave se inyecta en tiempo de build
(vía variables de entorno de Vite) y, por tanto, **queda incrustada en el bundle de
JavaScript que se sirve al navegador**. Cualquiera que use el sitio publicado o inspeccione
los archivos estáticos puede extraer la clave.

- **No publiques una clave de producción en el bundle.** Una clave expuesta puede
  consumirse hasta agotar tu cuota o facturación.
- **Para producción, las llamadas a la IA deben ir detrás de un proxy server-side**
  que custodie la clave, aplique límites de uso por usuario y no la revele al cliente.
  El cliente llamaría a tu backend, y el backend a Gemini.
- En desarrollo/demo, usa una clave de pruebas con cuota acotada y restricciones de
  uso, y trátala como comprometida en cuanto se despliegue.
- La app funciona sin `GEMINI_API_KEY`: solo se deshabilitan las funciones de IA.

## Controles aplicados

A pesar de los límites de la arquitectura, se aplican los siguientes controles:

- **Gate de tipos en el build.** El build ejecuta `tsc --noEmit && vite build`, de modo
  que no se publica código con errores de TypeScript, reduciendo defectos por tipos
  incorrectos.
- **Persistencia versionada.** El estado en `localStorage` está versionado; el estado
  con versión incompatible se descarta en lugar de cargarse a ciegas.
- **Degradación segura de IA.** Si falta la `GEMINI_API_KEY`, las funciones de IA se
  deshabilitan con una advertencia, en vez de fallar o filtrar errores.
- **Secretos fuera del repositorio.** La clave se toma de `.env.local` (ignorado por
  git); solo se versiona `.env.example` sin valores reales.
- **Sin secretos de terceros en el cliente más allá de la clave de IA.** No hay
  credenciales de base de datos ni tokens de servicios server-side embebidos, porque no
  hay backend.

## Resumen

Buyniverse es seguro **para su propósito**: una demostración local de cliente. **No es
apto para producción tal cual.** Un despliegue real exige, como mínimo: un backend con
autenticación y control de acceso (mitigando A01 y A07) y un proxy server-side que
custodie la `GEMINI_API_KEY`.
