import Form from 'vform'
import { getBaseURL } from '~/utils'

export default ({ $axios }) => {
  $axios.setBaseURL(getBaseURL())

  Form.axios = $axios
}
