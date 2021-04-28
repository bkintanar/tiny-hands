export default ({ store, redirect }) => {
  const user = store.getters['auth/user']

  if (user && !user.email_verified_at) {
    return redirect('/verification/resend')
  }
}
