import { useInfiniteQuery } from "@tanstack/react-query";
import { fetchProjects } from "../api/projectsApi";

export const useInfiniteProjects = () => {
  return useInfiniteQuery({
    queryKey: ["projects-infinite"],
    queryFn: ({ pageParam = "1" }) => fetchProjects(Number(pageParam)),
    initialPageParam: "1",
    getNextPageParam: (lastPage) => {
      const { page, last_page } = lastPage.data.pagination;
      return page < last_page ? page + 1 : undefined;
    },
  });
};
