import axios from 'axios';

const axiosInstance = axios.create({
  // 기본 URL 설정
  // baseURL: 'localhost:8000',

  // 기본 헤더 설정
  headers: {
    'Content-Type': 'application/json',
  }

});

export default axiosInstance;