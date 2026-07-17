export interface BaseResponse<T> {
  message: string;
  data: T;
}

export interface BasePaginationResponse<T> {
  message: string;
  data: {
    pagination: {
      page: number;
      per_page: number;
      last_page: number;
      total: number;
    };
    items: T[];
  };
}

export interface BaseDetailResponse<T, E = never> {
  message: string;
  data: T & E;
}
