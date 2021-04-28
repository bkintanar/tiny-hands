/**
 * Get cookie from request.
 *
 * @param  {Object} req
 * @param  {String} key
 * @return {String|undefined}
 */
export function cookieFromRequest(req, key) {
  if (!req.headers.cookie) {
    return
  }

  const cookie = req.headers.cookie
    .split(';')
    .find((c) => c.trim().startsWith(`${key}=`))

  if (cookie) {
    return cookie.split('=')[1]
  }
}

/**
 * https://router.vuejs.org/en/advanced/scroll-behavior.html
 */
export function scrollBehavior(to, from, savedPosition) {
  if (savedPosition) {
    return savedPosition
  }

  let position = {}

  if (to.matched.length < 2) {
    position = { x: 0, y: 0 }
  } else if (to.matched.some((r) => r.components.default.options.scrollToTop)) {
    position = { x: 0, y: 0 }
  }
  if (to.hash) {
    position = { selector: to.hash }
  }

  return position
}

export function getBaseURL() {
  const APP_DOMAIN = location.hostname
  const APP_PROTOCOL = location.protocol
  const APP_PORT = location.port

  let BASE_URL = APP_PROTOCOL + '//' + APP_DOMAIN + '/api'

  if (APP_PORT > 443) {
    BASE_URL = 'https://tenant1.tiny-hands.local/api'
  }

  return BASE_URL
}
