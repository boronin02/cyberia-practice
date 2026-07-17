import { api } from "@/shared/api/axiosInstance";
import { ReviewsResponse } from "./types";
import { useInfiniteQuery } from "@tanstack/react-query";

export const fetchReviews = async (pageNum: number): Promise<ReviewsResponse> => {
  const response = await api.get(`/api/reviews?page=${pageNum}`);
  return response.data;
};

export const useInfiniteReviews = () => {
  return useInfiniteQuery({
    queryKey: ["reviews-infinite"],
    queryFn: ({ pageParam = 1 }) => fetchReviews(pageParam),
    initialPageParam: 1,
    getNextPageParam: (lastPage) => {
      const { page, last_page } = lastPage.data.pagination;
      return page < Number(last_page) ? page + 1 : undefined;
    },
  });
};
