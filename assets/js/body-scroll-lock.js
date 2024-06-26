!(function (e, o) {
  if ("function" == typeof define && define.amd) define(["exports"], o)
  else if ("undefined" != typeof exports) o(exports)
  else {
    var t = {}
    o(t), (e.bodyScrollLock = t)
  }
})(this, function (exports) {
  "use strict"
  Object.defineProperty(exports, "__esModule", { value: !0 })
  var t = !1
  if ("undefined" != typeof window) {
    var e = {
      get passive() {
        t = !0
      },
    }
    window.addEventListener("testPassive", null, e),
      window.removeEventListener("testPassive", null, e)
  }
  function d(o) {
    return s.some(function (e) {
      return !(!e.options.allowTouchMove || !e.options.allowTouchMove(o))
    })
  }
  function l(e) {
    var o = e || window.event
    return (
      !!d(o.target) ||
      1 < o.touches.length ||
      (o.preventDefault && o.preventDefault(), !1)
    )
  }
  function n() {
    void 0 !== m && ((document.body.style.paddingRight = m), (m = void 0)),
      void 0 !== v && ((document.body.style.overflow = v), (v = void 0))
  }
  function i() {
    if (void 0 !== f) {
      var e = -parseInt(document.body.style.top, 10),
        o = -parseInt(document.body.style.left, 10)
      ;(document.body.style.position = f.position),
        (document.body.style.top = f.top),
        (document.body.style.left = f.left),
        window.scrollTo(o, e),
        (f = void 0)
    }
  }
  var c =
      "undefined" != typeof window &&
      window.navigator &&
      window.navigator.platform &&
      (/iP(ad|hone|od)/.test(window.navigator.platform) ||
        ("MacIntel" === window.navigator.platform &&
          1 < window.navigator.maxTouchPoints)),
    s = [],
    u = !1,
    a = -1,
    v = void 0,
    f = void 0,
    m = void 0
  ;(exports.disableBodyScroll = function (r, e) {
    if (r) {
      if (
        !s.some(function (e) {
          return e.targetElement === r
        })
      ) {
        var o = { targetElement: r, options: e || {} }
        ;(s = [].concat(
          (function (e) {
            if (Array.isArray(e)) {
              for (var o = 0, t = Array(e.length); o < e.length; o++)
                t[o] = e[o]
              return t
            }
            return Array.from(e)
          })(s),
          [o]
        )),
          c
            ? window.requestAnimationFrame(function () {
                if (void 0 === f) {
                  f = {
                    position: document.body.style.position,
                    top: document.body.style.top,
                    left: document.body.style.left,
                  }
                  var e = window,
                    o = e.scrollY,
                    t = e.scrollX,
                    n = e.innerHeight
                  ;(document.body.style.position = "fixed"),
                    (document.body.style.top = -o + "px"),
                    (document.body.style.left = -t + "px"),
                    setTimeout(function () {
                      return window.requestAnimationFrame(function () {
                        var e = n - window.innerHeight
                        e && n <= o && (document.body.style.top = -(o + e))
                      })
                    }, 300)
                }
              })
            : (function (e) {
                if (void 0 === m) {
                  var o = !!e && !0 === e.reserveScrollBarGap,
                    t = window.innerWidth - document.documentElement.clientWidth
                  if (o && 0 < t) {
                    var n = parseInt(
                      window
                        .getComputedStyle(document.body)
                        .getPropertyValue("padding-right"),
                      10
                    )
                    ;(m = document.body.style.paddingRight),
                      (document.body.style.paddingRight = n + t + "px")
                  }
                }
                void 0 === v &&
                  ((v = document.body.style.overflow),
                  (document.body.style.overflow = "hidden"))
              })(e),
          c &&
            ((r.ontouchstart = function (e) {
              1 === e.targetTouches.length && (a = e.targetTouches[0].clientY)
            }),
            (r.ontouchmove = function (e) {
              var o, t, n, i
              1 === e.targetTouches.length &&
                ((t = r),
                (i = (o = e).targetTouches[0].clientY - a),
                d(o.target) ||
                  ((t && 0 === t.scrollTop && 0 < i) ||
                  ((n = t) &&
                    n.scrollHeight - n.scrollTop <= n.clientHeight &&
                    i < 0)
                    ? l(o)
                    : o.stopPropagation()))
            }),
            u ||
              (document.addEventListener(
                "touchmove",
                l,
                t ? { passive: !1 } : void 0
              ),
              (u = !0)))
      }
    } else
      console.error(
        "disableBodyScroll unsuccessful - targetElement must be provided when calling disableBodyScroll on IOS devices."
      )
  }),
    (exports.clearAllBodyScrollLocks = function () {
      c &&
        (s.forEach(function (e) {
          ;(e.targetElement.ontouchstart = null),
            (e.targetElement.ontouchmove = null)
        }),
        u &&
          (document.removeEventListener(
            "touchmove",
            l,
            t ? { passive: !1 } : void 0
          ),
          (u = !1)),
        (a = -1)),
        (c ? i : n)(),
        (s = [])
    }),
    (exports.enableBodyScroll = function (o) {
      o
        ? ((s = s.filter(function (e) {
            return e.targetElement !== o
          })),
          c &&
            ((o.ontouchstart = null),
            (o.ontouchmove = null),
            u &&
              0 === s.length &&
              (document.removeEventListener(
                "touchmove",
                l,
                t ? { passive: !1 } : void 0
              ),
              (u = !1))),
          (c ? i : n)())
        : console.error(
            "enableBodyScroll unsuccessful - targetElement must be provided when calling enableBodyScroll on IOS devices."
          )
    })
})
